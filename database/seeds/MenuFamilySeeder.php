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
        $menu_families = ['CEVICHES','PARIHUELAS','ARROCES', 'CHICHARRONES','BEBIDAS','SUDADOS','PLATOS A LA CARTA','GUARNICIONES','OTROS'];
        foreach ($menu_families as $value) {
            MenuFamily::create([
                'name'   => $value
            ])->save();
        }
         
    }
}
