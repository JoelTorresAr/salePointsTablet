<?php

namespace App\Http\Controllers\Tablet;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\CommandMenu;
use App\Models\Floor;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['otro']]);
    }

    public function mesas(Request $request)
    {
        $tables = DB::table('tables')
            ->leftJoin('commands', 'commands.id', '=', 'tables.command_id')
            ->where([['tables.floor_id', $request['piso']], ['tables.state', 'A']])
            ->select(
                'tables.id as id',
                'tables.name as nombre',
                'tables.status as st_mesa',
                'commands.state as st_cmd',
                'commands.id as id_cmd',
                'tables.joined as juntada',
                'tables.order_status as orden',
                'commands.editing_by_name as mesero',
            )
            ->orderBy('tables.name')
            //->whereNull('commands.admin_id')
            ->get();

        return response()->json(['mesas' =>  $tables], 200);
    }
    public function nuevaComanda(Request $request)
    {
        $id_mesa = $request['id'];
        $mesa = Table::where('id', $id_mesa)->first();
        if (!$mozo = auth('api')->user()) {
            return response()->json(['msg' =>  'usuario no autenticado', 'status' => 401], 200);
        }
        if ($mesa['command_id'] == null) {
            /**
             * la mesa no tiene comandas registradas
             */
            $piso = Floor::where('id', $mesa['floor_id'])->first();
            DB::transaction(function () use ($piso, $mesa, $mozo) {
                $id_cmd = DB::table('commands')->insertGetId(
                    [
                        'cash_box_id'       => $piso['cash_box_id'],
                        'command_type_id'   => 1,
                        'floor_id'          => $piso['id'],
                        'table_id'          => $mesa['id'],
                        'editing_by_id'     => $mozo['id'],
                        'editing_by_name'   => $mozo['name'],
                    ]
                );

                DB::table('tables')->where('id', $mesa['id'])
                    ->update([
                        'status'      => 'O',
                        'command_id'  => $id_cmd,
                        'order_status' => 1
                    ]);
            });
            return response()->json(['msg' =>  'OK', 'status' => 1], 200);
        } else {
            if ($comanda = Command::where('id', $mesa['command_id'])->first()) {
                return response()->json(['msg' =>  'Comanda esta siendo Editada por mesero: ' . $comanda['editing_by_name'], 'status' => 0], 200);
            } else {
                return response()->json(['msg' =>  'Comanda no existe', 'status' => 0], 200);
            }
        }
    }
    public function agregarItem(Request $request)
    {
        $id_cmd = Table::where('id', $request['id_mesa'])->value('command_id');
        $id_prod = $request['id_producto'];

        $item = Menu::where('id', $id_prod)->first();
        if ($detalle = CommandMenu::where([['command_id', $id_cmd], ['menu_id', $id_prod]])->first()) {
            return $this->incrementarItemDetalle($detalle['id'], $id_cmd, $item);
        } else {
            return $this->crearItemDetalle($id_cmd, $item);
        }
    }
    public function listarItemsMesa(Request $request)
    {
        $id_cmd = Table::where('id', $request['id_mesa'])->value('command_id');

        return $this->responseWithItemsInComanda($id_cmd);
    }
    public function alterarLista(Request $request)
    {
        $id_cmd  = Table::where('id', $request['id_mesa'])->value('command_id');
        $item = Menu::where('id', $request['id_producto'])->first();
        $id_detalle = $request['id_detalle'];
        $cant    = $request['cantidad'];
        switch ($cant) {
            case 1:
                return $this->incrementarItemDetalle($id_detalle, $id_cmd, $item);
                break;
            case 0:
                $detalle = CommandMenu::where('id', $id_detalle)->first();
                return $this->eliminarItemDetalle($detalle, $id_cmd);
                break;

            default:
                $detalle = CommandMenu::where('id', $id_detalle)->first();
                if ($detalle->quantity == 1) {
                    return $this->eliminarItemDetalle($detalle, $id_cmd);
                } else {
                    return $this->disminuirItemDetalle($id_detalle, $id_cmd, $item);
                }
                break;
        }
    }
    protected function responseWithItemsInComanda($id_cmd)
    {
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

        return response()->json(['msg' =>  'Ok', 'prod' => $items, 'status' => 1], 200);
    }
    protected function crearItemDetalle($id_cmd, $item)
    {
        DB::beginTransaction();
        try {
            DB::table('command_menu')->insertGetId(
                [
                    'command_id'        => $id_cmd,
                    'menu_id'           => $item['id'],
                    'quantity'          => 1,
                    'sub_total'         => $item['sub_total'],
                    'igv'               => $item['igv'],
                    'total'             => $item['total']
                ]
            );

            DB::table('commands')->where('id', $id_cmd)->update(
                [
                    'subtotal'       => $item['sub_total'],
                    'igv'            => $item['igv'],
                    'total'          => $item['total']
                ]
            );

            DB::commit();
            return $this->responseWithItemsInComanda($id_cmd);
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' =>  'Ok', 'prod' => $e, 'status' => 0], 200);
            // something went wrong
        }
    }
    protected function incrementarItemDetalle($id_detalle, $id_cmd, $item)
    {
        DB::beginTransaction();
        try {
            DB::table('command_menu')->where('id', $id_detalle)->update(
                [
                    'quantity'          => DB::raw('quantity + 1'),
                    'sub_total'         => DB::raw('sub_total + ' . $item['sub_total']),
                    'igv'               => DB::raw('igv + ' . $item['igv']),
                    'total'             => DB::raw('total + ' . $item['total']),
                ]
            );

            DB::table('commands')->where('id', $id_cmd)->update(
                [
                    'subtotal'         => DB::raw('subtotal + ' . $item['sub_total']),
                    'igv'               => DB::raw('igv + ' . $item['igv']),
                    'total'             => DB::raw('total + ' . $item['total']),
                ]
            );

            DB::commit();
            return $this->responseWithItemsInComanda($id_cmd);
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' =>  'Ok', 'prod' => $e, 'status' => 0], 200);
        }
    }
    protected function disminuirItemDetalle($id_detalle, $id_cmd, $item)
    {
        DB::beginTransaction();
        try {
            DB::table('command_menu')->where('id', $id_detalle)->update(
                [
                    'quantity'          => DB::raw('quantity - 1'),
                    'sub_total'         => DB::raw('sub_total - ' . $item['sub_total']),
                    'igv'               => DB::raw('igv - ' . $item['igv']),
                    'total'             => DB::raw('total - ' . $item['total']),
                ]
            );

            DB::table('commands')->where('id', $id_cmd)->update(
                [
                    'subtotal'         => DB::raw('subtotal - ' . $item['sub_total']),
                    'igv'               => DB::raw('igv - ' . $item['igv']),
                    'total'             => DB::raw('total - ' . $item['total']),
                ]
            );

            DB::commit();
            return $this->responseWithItemsInComanda($id_cmd);
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' =>  'Ok', 'prod' => $e, 'status' => 0], 200);
        }
    }
    protected function eliminarItemDetalle($detalle, $id_cmd)
    {
        DB::beginTransaction();
        try {
            DB::table('commands')->where('id', $id_cmd)->update(
                [
                    'subtotal'         => DB::raw('subtotal - ' . $detalle['sub_total']),
                    'igv'               => DB::raw('igv - ' . $detalle['igv']),
                    'total'             => DB::raw('total - ' . $detalle['total']),
                ]
            );

            DB::table('command_menu')->where('id', $detalle['id'])->delete();

            DB::commit();
            // all good
            return $this->responseWithItemsInComanda($id_cmd);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json(['msg' =>  'Ok', 'prod' => $e, 'status' => 0], 200);
        }
    }
}
