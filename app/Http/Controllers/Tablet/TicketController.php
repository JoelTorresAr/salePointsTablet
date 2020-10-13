<?php

namespace App\Http\Controllers\Tablet;

use App\Http\Controllers\Controller;
use App\Jobs\CreateCommandBinnacle;
use App\Jobs\WarehouseDecrement;
use App\Models\Command;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Carbon\Carbon;
use Exception;
use Mike42\Escpos\Printer;

class TicketController extends Controller
{
    public function cocina(Request $request)
    {
        $mozo = $request['mozo'];
        $shop_id = $request['shop_id'];
        $user_id = $request['user_id'];
        $id_cmd = Table::where('id', $request['id_mesa'])->value('command_id');
        $items = DB::table('command_menu')
            ->leftJoin('menus', 'menus.id', '=', 'command_menu.menu_id')
            ->where([['command_menu.command_id', $id_cmd], ['command_menu.state', 'A']])
            ->select(
                'command_menu.id as id',
                'command_menu.quantity as cant',
                'command_menu.original_quantity as original',
                'command_menu.increment as increment',
                'command_menu.print_status as print',
                'menus.id as idprod',
                'menus.name as name',
            )
            ->orderBy('command_menu.id')
            //->whereNull('commands.admin_id')
            ->get();
        $notes = DB::table('notes')
            ->where([['notes.command_id', $id_cmd], ['notes.print_state', 0]])
            ->orderBy('notes.id')
            ->get();
        $detalles_sin_imprimir = 0;
        $detalles_alterados = 0;
        foreach ($items as $key => $value) {
            if ($value->print == 0) {
                $detalles_sin_imprimir++;
            }
            if ($value->increment != 0) {
                $detalles_alterados++;
            }
        };
        $detalles = ['mesa' => $request->mesa, 'shop_id' => $shop_id, 'notas' => $notes,'user_id' => $user_id];

        //Verifica que la comanda tenga detalles
        if ($detalles_sin_imprimir == 0 && $detalles_alterados == 0) {
            return response()->json(['msg' => 'No hay nada que enviar a cocina', 'status' => 0], 200);
        } else {
            return $this->imprimirCocina($items, $id_cmd, $mozo, $detalles);
        }
    }

    public function precuenta(Request $request)
    {
        $mozo = $request['mozo'];
        $user_id = $request['user_id'];
        $id_cmd = Table::where('id', $request['id_mesa'])->value('command_id');
        //$command = Command::where([['id', $id_cmd], ['state', '=', 2]])->first();
        $command = Command::where('id', $id_cmd)->first();
        if ($command->state == 2) {
            $detalles = ['mesa' => $request->mesa,'user_id'=>$user_id];
            $items = DB::table('command_menu')
                ->leftJoin('menus', 'menus.id', '=', 'command_menu.menu_id')
                ->where([['command_menu.command_id', $id_cmd], ['command_menu.state', 'A']])
                ->select(
                    'command_menu.id as id',
                    'command_menu.quantity as cant',
                    'command_menu.original_quantity as original',
                    'command_menu.increment as increment',
                    'command_menu.total as total',
                    'command_menu.print_status as print',
                    'menus.id as idprod',
                    'menus.name as name',
                )
                ->orderBy('command_menu.id')
                ->get();
            return $this->imprimirPrecuenta($items, $command, $mozo, $detalles);
        } elseif ($command->state == 3) {
            return response()->json(['msg' => 'La comanda ya fue enviado a precuenta', 'status' => 0], 200);
        } {
            return response()->json(['msg' => 'La comanda aun no fue enviada a cocina', 'status' => 0], 200);
        }
    }

    protected function imprimirCocina($items, $id_cmd, $mozo, $detalles)
    {
        DB::beginTransaction();
        try {
            DB::table('command_menu')->where('command_id', $id_cmd)->update(
                [
                    'print_status'      => 1,
                    'increment'         => 0,
                ]
            );
            DB::table('commands')->where('id', $id_cmd)->update(
                [
                    'state'         => 2,
                    'print_number'  =>  DB::raw('print_number + 1'),
                ]
            );
            DB::table('notes')->where('command_id', $id_cmd)->update(
                [
                    'print_state'      => 1,
                ]
            );
            //WarehouseDecrement::dispatch($id_cmd, $detalles['shop_id']);
            dispatch(new WarehouseDecrement($id_cmd, $detalles['shop_id']));
            dispatch(new CreateCommandBinnacle('A', $id_cmd, $detalles['user_id'], 'IMPRIMIO EN COCINA'));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['msg' => $e, 'status' => 0, 'tipo' => 'db'], 200);
        }


        try {

            $print_number = DB::table('commands')
                ->where('id', $id_cmd)
                ->value('print_number');

            $date_time = Carbon::now('America/Lima')->toDateTimeString();
            // Configuracion de conexion
            $nombreImpresora = "Cocina";
            $connector = new WindowsPrintConnector($nombreImpresora);
            $impresora = new Printer($connector);
            // Cabecera de ticket
            $impresora->setDoubleStrike(false);
            $impresora->setJustification(Printer::JUSTIFY_CENTER);
            $impresora->setTextSize(8, 8);
            $impresora->setFont(Printer::FONT_B);/*
            $impresora->text("COCINA \n");
            $impresora->setTextSize(4, 4);
            $impresora->setFont(Printer::FONT_B);*/
            $impresora->text($detalles['mesa'] . "\n");
            $impresora->setTextSize(2, 2);
            $impresora->text("IMPRESION N°: ".$print_number . "\n");
            $impresora->feed(1);

            //Detalle
            $impresora->setJustification(Printer::JUSTIFY_LEFT);
            $impresora->setEmphasis(true);
            $impresora->text("MOZO: " . $mozo . "\n");
            $impresora->text("Fecha-Hora: " . $date_time . "\n");
            $impresora->feed(1);
            $impresora->setJustification(Printer::JUSTIFY_RIGHT);
            $impresora->text(new itemCocina('CANT', 'PRODUCTO'));
            $impresora->setJustification(Printer::JUSTIFY_CENTER);
            $impresora->text("******************************\n");
            $impresora->feed(2);
            //Items
            $impresora->setEmphasis(false);
            $impresora->setJustification(Printer::JUSTIFY_LEFT);
            foreach ($items as $key => $value) {
                $std_imp = $value->print;
                $nombre = $value->name;
                $cant   =  $value->cant;
                $incremento = $value->increment;
                if ($std_imp == 0) {
                    $impresora->text(new itemCocina("(" . $cant . ")", $nombre));
                    $impresora->feed(1);
                } else {
                    if ($incremento != 0) {
                        $signo = $incremento <=> 0;
                        if ($signo == -1) {
                            $impresora->text(new itemCocina("(" . $cant . ")", $nombre . " (" . "-" . $incremento . ")"));
                            $impresora->feed(1);
                        }
                        if ($signo == 1) {
                            $impresora->text(new itemCocina("(" . $cant . ")", $nombre . " (" . "+" . $incremento . ")"));
                            $impresora->feed(1);
                        }
                    }
                }
            }
            $impresora->setJustification(Printer::JUSTIFY_LEFT);
            foreach ($detalles['notas'] as $key => $value) {
                $impresora->text("Nota: " . $value->note . "\n");
                $impresora->feed(1);
            }

            $impresora->feed(1);
            $impresora->cut(Printer::CUT_PARTIAL);
            //$impresora->cut();
            $impresora->close();
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Error de ticketera', 'status' => 0, 'tipo' => 'tikect'], 200);
        } catch (\Throwable $e) {
            return response()->json(['msg' => 'Error de ticketera', 'status' => 0, 'tipo' => 'tikect'], 200);
        }
        return response()->json(['msg' => 'OK', 'status' => 1], 200);
    }

    protected function imprimirPrecuenta($items, $command, $mozo, $detalles)
    {
        DB::beginTransaction();
        try {
            DB::table('commands')->where('id', $command->id)->update(
                [
                    'state'      => 3,
                ]
            );

            dispatch(new CreateCommandBinnacle('A', $command->id, $detalles['user_id'], 'IMPRIMIO PRECUENTA'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' => $e, 'status' => 0, 'tipo' => 'db'], 200);
        }

        try {

            $date_time = Carbon::now('America/Lima')->toDateTimeString();
            // Configuracion de conexion
            $nombreImpresora = "Cocina";
            $connector = new WindowsPrintConnector($nombreImpresora);
            $impresora = new Printer($connector);
            // Cabecera de ticket
            $impresora->setDoubleStrike(false);
            $impresora->setJustification(Printer::JUSTIFY_CENTER);
            $impresora->setTextSize(4, 1.5);
            $impresora->text("PRE-CUENTA\n");
            $impresora->feed(1);
            $impresora->setJustification(Printer::JUSTIFY_LEFT);
            $impresora->setTextSize(1, 1.5);
            $impresora->setEmphasis(true);
            $impresora->setFont(Printer::FONT_B);
            $impresora->text("MOZO: " . $mozo . "\n");
            $impresora->text("Fecha-Hora: " . $date_time . "\n");
            $impresora->feed(1);
            $impresora->setJustification(Printer::JUSTIFY_RIGHT);
            $impresora->text(new itemPrecuenta('Cant ', 'Descripcion', 'Sub Total'));
            $asterisco = '';
            $linea = '';
            for ($i = 0; $i < 64; $i++) {
                $asterisco = $asterisco . '*';
                $linea = $linea . '-';
            }
            $impresora->text($asterisco . "\n");
            $impresora->feed(2);
            //Items
            $impresora->setEmphasis(false);
            $impresora->setJustification(Printer::JUSTIFY_RIGHT);

            foreach ($items as $key => $value) {
                $nombre = $value->name;
                $cant   =  $value->cant;
                $total = $value->total;
                $impresora->text(new itemPrecuenta($cant, $nombre, $total));
                $impresora->feed(1);
            }

            $impresora->text($linea . "\n");
            $impresora->feed(1);
            $impresora->setEmphasis(true);
            $impresora->text("Total Pagar:       " . $command->total);
            $impresora->feed(2);
            $impresora->setJustification(Printer::JUSTIFY_CENTER);
            $impresora->setEmphasis(false);
            $impresora->text("Este no es un comprobante de Pago.\n");
            $impresora->text("Por favor canjear en caja si desea factura o ticket\n");
            $impresora->text("Gracias por su gentil preferencia\n");
            $impresora->feed(1);
            $impresora->cut(Printer::CUT_PARTIAL);
            //$impresora->cut();
            $impresora->close();
            // Pie de pagina
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Error de ticketera', 'status' => 0, 'tipo' => 'tikect'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Error de ticketera', 'status' => 0, 'tipo' => 'tikect'], 200);
        }
        return response()->json(['msg' => 'OK', 'status' => 1], 200);
    }
}
/* A wrapper to do organise item names & prices into columns */
class itemCocina
{
    private $name;
    private $cant;

    public function __construct($cant = '', $name = '')
    {
        $this->name = $name;
        $this->cant = $cant;
    }

    public function __toString()
    {
        $rightCols = 27;
        $leftCols = 5;
        $left = str_pad($this->cant, $leftCols);
        $right = str_pad($this->name, $rightCols, ' ', STR_PAD_LEFT);
        //34
        // DD("$left$right\n");
        return "$left$right\n";
    }
}
class itemPrecuenta
{
    private $cant;
    private $name;
    private $price;

    public function __construct($cant = '', $name = '', $price = '')
    {
        $this->cant = $cant;
        $this->name = $name;
        $this->price = $price;
    }

    public function __toString()
    {
        $rightCols = 9;
        $interCols = 50;
        $leftCols  = 4;
        $left = str_pad($this->cant, $leftCols);
        $inter = str_pad($this->name, $interCols);

        $lengthName = strlen($this->name);
        if ($lengthName > 49) {
            $inter = substr($this->name, 0, 47) . "...";
        }

        $right = str_pad($this->price, $rightCols, ' ', STR_PAD_LEFT);
        // DD("$left$right\n");
        return "$left$inter$right\n";
    }
}
