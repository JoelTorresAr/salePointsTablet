<?php

namespace App\Http\Controllers\Tablet;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MesaController extends Controller
{
    public function juntar(Request $request)
    {
        $mesa_id = $request['id_mesa'];
        $mesas = $request['mesas'];
        $id_cmd  = $request['id_cmd'];
        DB::beginTransaction();
        try {
            DB::table('tables')->where('id', $mesa_id)->update(
                [
                    'joined' =>  1,
                ]
            );

            DB::table('tables')
                ->whereIn('id', $mesas)
                ->update(
                    [
                        'command_id' => $id_cmd,
                        'joined'     =>  1,
                        'status'     => 'O'
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
    public function separar(Request $request)
    {
        $mesa_id = $request['id_mesa'];
        $id_cmd  = $request['id_cmd'];
        DB::beginTransaction();
        try {
            DB::table('tables')
                ->where('command_id', $id_cmd)
                ->update(
                    [
                        'command_id' => null,
                        'joined'     =>  0,
                        'status'     => 'L'
                    ]
                );

            DB::table('tables')->where('id', $mesa_id)->update(
                [
                    'command_id' => $id_cmd,
                    'status'     => 'O'
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
    public function mover(Request $request)
    {
        $mesa_id = $request['id_mesa'];
        $id_cmd  = $request['id_cmd'];
        DB::beginTransaction();
        try {
            DB::table('tables')
                ->where('command_id', $id_cmd)
                ->update(
                    [
                        'command_id' => null,
                        'joined'     =>  0,
                        'status'     => 'L'
                    ]
                );

            DB::table('tables')->where('id', $mesa_id)->update(
                [
                    'command_id' => $id_cmd,
                    'status'     => 'O'
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
