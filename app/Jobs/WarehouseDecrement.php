<?php

namespace App\Jobs;

use App\Models\CommandMenu;
use App\Models\MenuSupply;
use App\Models\Warehouse;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class WarehouseDecrement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $id_cmd;
    private string $shop_id;

    public function __construct(string $id_cmd, string $shop_id)
    {
        $this->id_cmd = $id_cmd;
        $this->shop_id = $shop_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $almacen_id = Warehouse::where('shop_id', $this->shop_id)->value('id');
            if ($detallesC = CommandMenu::where([['command_id', $this->id_cmd], ['command_menu.state', 'A']])->get()) {
                foreach ($detallesC as $key => $detalleC) {
                    if ($detallesM = MenuSupply::where([['menu_id', $detalleC->menu_id]])->get()) {
                        foreach ($detallesM as $key => $detalleM) {
                            DB::beginTransaction();
                            try {
                                $cantidad =$detalleC->quantity;
                                if ($detalleC->original_quantity == 0) {
                                    $total = $detalleC->quantity * (float) $detalleM->quantity;
                                    DB::table('supply_warehouse')->where([['warehouse_id', $almacen_id], ['supply_id', $detalleM->supply_id]])->update(
                                        [
                                            'current_quantity'          => DB::raw('current_quantity - ' . $total),
                                        ]
                                    );
                                } else {
                                    $total = ($detalleC->quantity - $detalleC->original_quantity) * (float) $detalleM->quantity;
                                    DB::table('supply_warehouse')->where([['warehouse_id', $almacen_id], ['supply_id', $detalleM->supply_id]])->update(
                                        [
                                            'current_quantity'          => DB::raw('current_quantity - ' . $total),
                                        ]
                                    );
                                }
                                DB::table('command_menu')->where('id', $detalleC->id)->update(
                                    [
                                        'original_quantity' => $cantidad,
                                    ]
                                );
                                DB::commit();
                                echo 'Almacen alterado';
                                // all good
                            } catch (Exception $e) {
                                DB::rollback();
                                $this->failed($e);
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            // bird is clearly not the word
            $this->failed($e);
        }
    }
    public function failed($exception)
    {
        echo $exception->getMessage();
    }
}
