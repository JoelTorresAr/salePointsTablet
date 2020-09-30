<?php

namespace App\Http\Controllers\Tablet;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Carbon\Carbon;
use Mike42\Escpos\Printer;

class TicketController extends Controller
{
    public function imprimirCocina(Request $request)
    {
        $nombre_mesa = $request->mesa;
        $id_cmd = Table::where('id', $request['id_mesa'])->value('command_id');
        $command = Command::where('id', $id_cmd)->first();
        $items = DB::table('command_menu')
            ->leftJoin('menus', 'menus.id', '=', 'command_menu.menu_id')
            ->where([['command_menu.command_id', $id_cmd], ['command_menu.state', 'A']])
            ->select(
                'command_menu.id as id',
                'menus.id as idprod',
                'menus.name as name',
                'command_menu.quantity as cant',
                'command_menu.total as subtotal',
                'command_menu.print_status as print',
            )
            ->orderBy('command_menu.id')
            //->whereNull('commands.admin_id')
            ->get();
        $this->imprimir('cocina', $items, $command, $nombre_mesa);
    }
    protected function imprimir($destino, $items, $command, $detalles)
    {
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
            $impresora->text($destino . "\n");
            $impresora->setTextSize(4, 4);
            $impresora->setFont(Printer::FONT_B);
            $impresora->text($detalles . "\n");
            //Detalle
            $impresora->setJustification(Printer::JUSTIFY_RIGHT);
            $impresora->setEmphasis(true);
            $impresora->setTextSize(2, 2);
            $impresora->text(new item('PRODUCTO', 'CANT'));
            $impresora->setJustification(Printer::JUSTIFY_CENTER);
            $impresora->text("-----------------------------\n");
            $impresora->feed(2);
            //Items
            $impresora->setEmphasis(false);
            $impresora->setJustification(Printer::JUSTIFY_RIGHT);
            foreach ($items as $key => $value) {
                $impresora->text(new item($value->name, $value->cant));
                $impresora->feed(1);
            }

            $impresora->feed(1);
            // Pie de pagina
            $impresora->setTextSize(1, 1);
            $impresora->text("Fecha-Hora: ".$date_time);
            $impresora->feed(1);

        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            $impresora->cut();
            $impresora->close();
        };
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
