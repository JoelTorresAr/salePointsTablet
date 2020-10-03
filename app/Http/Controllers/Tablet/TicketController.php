<?php

namespace App\Http\Controllers\Tablet;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\CommandMenu;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Carbon\Carbon;
use Mike42\Escpos\Printer;

class TicketController extends Controller
{
    public function cocina(Request $request)
    {
        $mozo = $request['mozo'];
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
        $detalles = ['mesa' => $request->mesa];

        //Verifica que la comanda tenga detalles
        if ($detalles_sin_imprimir == 0 && $detalles_alterados == 0) {
            return response()->json(['msg' => 'OK', 'status' => 1], 200);
        } else {
            return $this->imprimirCocina($items, $id_cmd, $mozo, $detalles);
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
                    'state'      => 2,
                ]
            );

            try {

                $date_time = Carbon::now('America/Lima')->toDateTimeString();
                // Configuracion de conexion
                $nombreImpresora = "ImpresoraTermica";
                $connector = new WindowsPrintConnector($nombreImpresora);
                $impresora = new Printer($connector);
                // Cabecera de ticket
                $impresora->setDoubleStrike(false);
                $impresora->setJustification(Printer::JUSTIFY_CENTER);
                $impresora->setTextSize(8, 8);
                $impresora->setFont(Printer::FONT_B);
                $impresora->text("COCINA \n");
                $impresora->setTextSize(4, 4);
                $impresora->setFont(Printer::FONT_B);
                $impresora->text($detalles['mesa'] . "\n");
                //Detalle
                $impresora->setJustification(Printer::JUSTIFY_LEFT);
                $impresora->setEmphasis(true);
                $impresora->setTextSize(2, 2);
                $impresora->text("MOZO: " . $mozo . "\n");
                $impresora->text("Fecha-Hora: " . $date_time . "\n");
                $impresora->feed(1);
                $impresora->setJustification(Printer::JUSTIFY_RIGHT);
                $impresora->text(new item('PRODUCTO', 'CANT'));
                $impresora->setJustification(Printer::JUSTIFY_CENTER);
                $impresora->text("******************************\n");
                $impresora->feed(2);
                //Items
                $impresora->setEmphasis(false);
                $impresora->setJustification(Printer::JUSTIFY_RIGHT);
                foreach ($items as $key => $value) {
                    $std_imp = $value->print;
                    $nombre = $value->name;
                    $cant   =  $value->cant;
                    $incremento = $value->increment;
                    if ($std_imp == 0) {
                        $impresora->text(new item($nombre, $cant));
                        $impresora->feed(1);
                    } else {
                        if ($incremento != 0) {
                            $signo = $incremento <=> 0;
                            if ($signo == -1) {
                                $impresora->text(new item($nombre . " (" ."-". $incremento . ")", $cant));
                                $impresora->feed(1);
                            }
                            if ($signo == 1) {
                                $impresora->text(new item($nombre . " (" . "+" . $incremento . ")", $cant));
                                $impresora->feed(1);
                            }
                        }
                    }
                }

                $impresora->feed(1);
                // Pie de pagina
                /*
                $impresora->setJustification(Printer::JUSTIFY_LEFT);
                $impresora->setTextSize(1, 1);
                $impresora->text("Fecha-Hora: " . $date_time);
                $impresora->feed(1);*/
            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json(['msg' => $th, 'status' => 0, 'tipo' => 'tikect'], 200);
            } finally {
                $impresora->cut();
                $impresora->close();
            };
            DB::commit();
            return response()->json(['msg' => 'OK', 'status' => 1], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' => $e, 'status' => 0, 'tipo' => 'db'], 200);
        }
    }
    public function precuenta(Request $request)
    {
        $mozo = $request['mozo'];
        $id_cmd = Table::where('id', $request['id_mesa'])->value('command_id');

        if ($command = Command::where([['id', $id_cmd], ['state','!=', 3]])->first()) {
            $detalles = ['mesa' => $request->mesa];
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
                ->get();
            return $this->imprimirPrecuenta($items, $command, $mozo, $detalles);
        } else {
            return response()->json(['msg' => 'La comanda ya fue enviado a precuenta', 'status' => 0], 200);
        }
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

            /*
            try {

                $date_time = Carbon::now('America/Lima')->toDateTimeString();
                // Configuracion de conexion
                $nombreImpresora = "ImpresoraTermica";
                $connector = new WindowsPrintConnector($nombreImpresora);
                $impresora = new Printer($connector);
                // Cabecera de ticket
                $impresora->setDoubleStrike(false);
                $impresora->setJustification(Printer::JUSTIFY_CENTER);
                $impresora->setTextSize(8, 8);
                //$impresora->setFont(Printer::FONT_B);
                $impresora->text("PRE - CUENTA\n");
                $impresora->setTextSize(4, 4);
                $impresora->setFont(Printer::FONT_B);
                $impresora->text($detalles['mesa'] . "\n");
                //Detalle
                $impresora->setJustification(Printer::JUSTIFY_LEFT);
                $impresora->setEmphasis(true);
                $impresora->setTextSize(2, 2);
                $impresora->text("MOZO: " . $mozo . "\n");
                $impresora->text("Fecha-Hora: " . $date_time . "\n");
                $impresora->feed(1);
                $impresora->setJustification(Printer::JUSTIFY_RIGHT);
                $impresora->text(new item('PRODUCTO', 'CANT'));
                $impresora->setJustification(Printer::JUSTIFY_CENTER);
                $impresora->text("******************************\n");
                $impresora->feed(2);
                //Items
                $impresora->setEmphasis(false);
                $impresora->setJustification(Printer::JUSTIFY_RIGHT);
                foreach ($items as $key => $value) {
                    $std_imp = $value->print;
                    $nombre = $value->name;
                    $cant   =  $value->cant;
                    $incremento = $value->increment;
                    if ($std_imp == 0) {
                        $impresora->text(new item($nombre, $cant));
                        $impresora->feed(1);
                    } else {
                        if ($incremento != 0) {
                            $signo = $incremento <=> 0;
                            if ($signo == -1) {
                                $impresora->text(new item($nombre . " (" . $incremento . ")", $cant));
                                $impresora->feed(1);
                            }
                            if ($signo == 1) {
                                $impresora->text(new item($nombre . " (" . "+" . $incremento . ")", $cant));
                                $impresora->feed(1);
                            }
                        }
                    }
                }

                $impresora->feed(1);
                // Pie de pagina
                
               // $impresora->setJustification(Printer::JUSTIFY_LEFT);
                //$impresora->setTextSize(1, 1);
                //$impresora->text("Fecha-Hora: " . $date_time);
                //$impresora->feed(1);
            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json(['msg' => $th, 'status' => 0, 'tipo' => 'tikect'], 200);
            } finally {
                $impresora->cut();
                $impresora->close();
            };
            */
            DB::commit();
            return response()->json(['msg' => 'OK', 'status' => 1], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' => $e, 'status' => 0, 'tipo' => 'db'], 200);
        }
    }
}
/* A wrapper to do organise item names & prices into columns */
class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this->name = $name;
        $this->price = $price;
        $this->dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 8;
        $leftCols = 24;
        if ($this->dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this->name, $leftCols);

        $sign = ($this->dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this->price, $rightCols, ' ', STR_PAD_LEFT);
        //34
        // DD("$left$right\n");
        return "$left$right\n";
    }
}
