<?php

use App\Models\MenuFamily;
use App\Models\Supply;
use App\Models\Unity;
use App\Models\Warehouse;
use App\Models\WarehouseFamily;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unity::create([
            'name' => 'Unidad'
        ]);
        Warehouse::create([
            'name'    => 'Cocina',
            'shop_id' => 1
        ]);
        $menu_families = ['CEVICHES', 'LECHES Y CHILCANOS', 'RONDAS MARINAS', 'FRITURAS', 'JALEAS','TIRADITOS','ARROCES','PARIHUELAS','SUDADOS','CHICHARRONES','GUARNICIONES','BEBIDAS','C. CRIOLLA'];
        foreach ($menu_families as $value) {
            MenuFamily::create([
                'name'   => $value
            ])->save();
        }
        /*
        $warehouse_families = ['POLLO', 'VEGETALES','ABRARROTES' , 'COMPLEMENTOS', 'CARNES', 'GASEOSAS', 'AGUAS', 'LICORES'];
        foreach ($warehouse_families as $value) {
            WarehouseFamily::create([
                'name'  => $value
            ]);
        }

        Supply::create([
            'name'                  => 'POLLO',
            'warehouse_family_id'  => 1,
            'unity_id'              => 1,
            'production_unity'      => 1,
            'factor'                => 1, 
            'auto_conversion'       => 1,
            'description'           => '',
        ]);
        Supply::create([
            'name'                  => 'PAPA',
            'warehouse_family_id'  => 2,
            'unity_id'              => 1,
            'production_unity'      => 1,
            'factor'                => 1, 
            'auto_conversion'       => 1,
            'description'           => '',
        ]);
        Supply::create([
            'name'                  => 'PEPSI',
            'warehouse_family_id'  => 6,
            'unity_id'              => 1,
            'production_unity'      => 1,
            'factor'                => 1, 
            'auto_conversion'       => 1,
            'description'           => '',
        ]);
        Supply::create([
            'name'                  => 'INKA',
            'warehouse_family_id'  => 6,
            'unity_id'              => 1,
            'production_unity'      => 1,
            'factor'                => 1, 
            'auto_conversion'       => 1,
            'description'           => '',
        ]);

        DB::table('supply_warehouse')->insert(
            [
                'warehouse_id'      => 1,
                'supply_id'         => 1,
                'current_quantity'  => 300,
            ]
        );
        DB::table('supply_warehouse')->insert(
            [
                'warehouse_id'      => 1,
                'supply_id'         => 2,
                'current_quantity'  => 300,
            ]
        );
        DB::table('supply_warehouse')->insert(
            [
                'warehouse_id'      => 1,
                'supply_id'         => 3,
                'current_quantity'  => 300,
            ]
        );
        DB::table('supply_warehouse')->insert(
            [
                'warehouse_id'      => 1,
                'supply_id'         => 4,
                'current_quantity'  => 300,
            ]
        );*/
         
    }
}
