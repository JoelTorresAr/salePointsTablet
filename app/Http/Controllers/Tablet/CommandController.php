<?php

namespace App\Http\Controllers\Tablet;

use App\Http\Controllers\Controller;
use App\Jobs\CreateCommandBinnacle;
use App\Models\Command;
use App\Models\CommandMenu;
use App\Models\Floor;
use App\Models\Menu;
use App\Models\Opening;
use App\Models\Table;
use App\User;
use Exception;
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
            ->orderBy('tables.id')
            //->whereNull('commands.admin_id')
            ->get();

        return response()->json(['mesas' =>  $tables], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return 
     */
    public function nuevaComanda(Request $request)
    {
        $id_mesa = $request['id'];
       // $cash_box_id = $request['id_caja'];
        
        
        $mesa = Table::where('id', $id_mesa)->first();
        $piso = Floor::where('id', $mesa['floor_id'])->first();

        if (!$opening = Opening::where([['cash_box_id', $piso['cash_box_id']], ['state', 'A']])->value('id')) {
            return  response()->json(['msg' => 'No se aperturo caja'], 401);
        }
        if (!$mozo = auth('api')->user()) {
            return response()->json(['msg' =>  'usuario no autenticado', 'status' => 401], 200);
        }
        if ($mesa['command_id'] == null) {
            /**
             * la mesa no tiene comandas registradas
             */

            DB::beginTransaction();
            try {
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
                        'status'       => 'O',
                        'command_id'   => $id_cmd,
                        'order_status' => 1,
                        'original_cmd' => 'A'
                    ]);

                DB::commit();
                dispatch(new CreateCommandBinnacle('C', $id_cmd, $mozo['id'], 'CREACION'));
                // event(new CommandBinnacle('CREACION', $id_cmd, $mozo['id'], ''));
                return response()->json(['msg' =>  'OK', 'status' => 1], 200);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(['msg' => $e, 'status' => 0, 'tipo' => 'db'], 200);
            }
        } else {
            $comanda = Command::where('id', $mesa['command_id'])->first();
            if ($comanda->state == 3) {
                return response()->json(['msg' => 'La comanda ya fue enviado a precuenta', 'status' => 0], 200);
            }
            if ($comanda->editing_by_id != null) {
                /**
                 * La comanda existe y esta siendo atendida
                 */
                return response()->json(['msg' =>  'Comanda esta siendo Editada por mesero: ' . $comanda['editing_by_name'], 'status' => 0], 200);
            } else {
                /**
                 * Existe la comanda pero nadie la esta atendiendo
                 */
                DB::beginTransaction();
                try {
                    DB::table('commands')->where('id', $mesa['command_id'])->update(
                        [
                            'editing_by_id'     => $mozo['id'],
                            'editing_by_name'   => $mozo['name'],
                        ]
                    );

                    DB::commit();
                    dispatch(new CreateCommandBinnacle('A', $mesa['command_id'], $mozo['id'], 'INGRESO'));
                    return response()->json(['msg' =>  'OK', 'status' => 1], 200);
                    // all good
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['msg' =>  $e, 'status' => 0], 200);
                }
            }
        }
    }
    public function agregarNota(Request $request)
    {
        $id_cmd = Table::where('id', $request['id_mesa'])->value('command_id');
        $nota = $request['nota'];
        $cash_box_id = $request['id_caja'];
        if (!$opening = Opening::where([['cash_box_id', $cash_box_id], ['state', 'A']])->value('id')) {
            return  response()->json(['msg' => 'No se aperturo caja'], 401);
        }

        DB::beginTransaction();
        try {
            DB::table('notes')->insertGetId(
                [
                    'command_id'   => $id_cmd,
                    'note'         => $nota,
                ]
            );

            DB::commit();
            return response()->json(['msg' =>  'OK', 'status' => 1], 200);
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' =>  $e, 'status' => 0], 200);
        }
    }
    public function agregarItem(Request $request)
    {
        $id_cmd = Table::where('id', $request['id_mesa'])->value('command_id');
        $id_prod = $request['id_producto'];
        $cash_box_id = $request['id_caja'];
        if (!$opening = Opening::where([['cash_box_id', $cash_box_id], ['state', 'A']])->value('id')) {
            return  response()->json(['msg' => 'No se aperturo caja'], 401);
        }

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
        $cash_box_id = $request['id_caja'];
        if (!$opening = Opening::where([['cash_box_id', $cash_box_id], ['state', 'A']])->value('id')) {
            return  response()->json(['msg' => 'No se aperturo caja'], 401);
        }

        return $this->responseWithItemsInComanda($id_cmd);
    }
    public function alterarLista(Request $request)
    {
        $cash_box_id = $request['id_caja'];
        if (!$opening = Opening::where([['cash_box_id', $cash_box_id], ['state', 'A']])->value('id')) {
            return  response()->json(['msg' => 'No se aperturo caja'], 401);
        }
        $id_cmd  = Table::where('id', $request['id_mesa'])->value('command_id');
        $item = Menu::where('id', $request['id_producto'])->first();
        $id_detalle = $request['id_detalle'];
        $cant    = $request['cantidad'];
        $restring = $request['restring'];
        $auth = $request['auth'];
        switch ($cant) {
            case 1:
                return $this->incrementarItemDetalle($id_detalle, $id_cmd, $item);
                break;
            case 0:
                $detalle = CommandMenu::where('id', $id_detalle)->first();
                return $this->eliminarItemDetalle($detalle, $id_cmd, $restring, $auth);
                break;

            default:
                $detalle = CommandMenu::where('id', $id_detalle)->first();
                if ($detalle['print_status'] == 1 && $detalle['increment'] == 0) {
                    if ($restring) {
                        if (!$user = User::select('id', 'name')->where([['pin', $auth], ['state', 'A']])->first()) {
                            return  response()->json(['msg' => 'Acceso no autorizado(user)'], 200);
                        }
                        if (!$user->hasRole('administrador')) {
                            return  response()->json(['msg' => 'Acceso no autorizado'], 200);
                        }
                    }
                    //  return response()->json(['msg' =>  'Esta accion solo la puede hacer un administrador', 'status' => 0], 200);
                }
                if ($detalle->quantity == 1) {
                    return $this->eliminarItemDetalle($detalle, $id_cmd, $restring, $auth);
                } else {
                    return $this->disminuirItemDetalle($id_detalle, $id_cmd, $item);
                }
                break;
        }
    }
    protected function responseWithItemsInComanda($id_cmd)
    {
        $command = Command::where('id', $id_cmd)->first();
        $items = DB::table('command_menu')
            ->leftJoin('menus', 'menus.id', '=', 'command_menu.menu_id')
            ->where([['command_menu.command_id', $id_cmd], ['command_menu.state', 'A']])
            ->select(
                'command_menu.id as id',
                'menus.id as idprod',
                'menus.name as name',
                'command_menu.quantity as cant',
                'command_menu.increment as increment',
                'command_menu.total as subtotal',
                'command_menu.print_status as print',
            )
            ->orderBy('command_menu.id')
            //->whereNull('commands.admin_id')
            ->get();

        return response()->json(['msg' =>  'Ok', 'prod' => $items, 'status' => 1, 'total' => $command['total']], 200);
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
                    'increment'         => DB::raw('increment + 1'),
                    'sub_total'         => DB::raw('sub_total + ' . $item['sub_total']),
                    'igv'               => DB::raw('igv + ' . $item['igv']),
                    'total'             => DB::raw('total + ' . $item['total']),
                    'state'             => 'A',
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
                    'increment'         => DB::raw('increment - 1'),
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
            return response()->json(['msg' =>  $e, 'status' => 0], 200);
        }
    }
    protected function eliminarItemDetalle($detalle, $id_cmd, $restring, $auth)
    {

        if ($restring) {
            if (!$user = User::select('id', 'name')->where([['pin', $auth], ['state', 'A']])->first()) {
                return  response()->json(['msg' => 'Acceso no autorizado(user)'], 200);
            }
            if (!$user->hasRole('administrador')) {
                return  response()->json(['msg' => 'Acceso no autorizado'], 200);
            }
        }
        DB::beginTransaction();
        try {
            DB::table('commands')->where('id', $id_cmd)->update(
                [
                    'subtotal'         => DB::raw('subtotal - ' . $detalle['sub_total']),
                    'igv'               => DB::raw('igv - ' . $detalle['igv']),
                    'total'             => DB::raw('total - ' . $detalle['total']),
                ]
            );
            if ($detalle['print_status'] == 1) {
                DB::table('command_menu')->where('id', $detalle['id'])->update(
                    [
                        'state'          => 'E',
                    ]
                );
            } else {
                DB::table('command_menu')->where('id', $detalle['id'])->delete();
            }

            DB::commit();
            // all good
            return $this->responseWithItemsInComanda($id_cmd);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json(['msg' =>  $e, 'status' => 0], 200);
        }
    }
    public function liberar(Request $request)
    {
        $cash_box_id = $request['id_caja'];
        if (!$opening = Opening::where([['cash_box_id', $cash_box_id], ['state', 'A']])->value('id')) {
            return  response()->json(['msg' => 'No se aperturo caja'], 401);
        }
        $mesa = Table::where('id', $request->id_mesa)->first();
        DB::beginTransaction();
        try {
            DB::table('commands')->where('id', $mesa['command_id'])->update(
                [
                    'editing_by_id'    => null,
                    'editing_by_name'  => null,
                ]
            );

            DB::commit();
            return response()->json(['msg' =>  'Ok', 'status' => 1], 200);
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' =>  $e, 'status' => 0], 200);
        }
    }
}
