<?php

use App\Models\Menu;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* $shop = Shop::select('id')->first();
        for ($i=0; $i < 40; $i++) { 
           $shop->menus()->Create([
                'menu_family_id' => rand(1,10),
                'printer'        => 'impresora cocina',
                'name'           => 'Menu '.$i,
                'sub_total'      => 20.50,
                'igv'            => 4.50,
                'total'          => 25.00,
                'state'          => 'A',
            ]);
        }*/
        
        for ($i=0; $i < 80; $i++) { 
           Menu::create([
                'menu_family_id' => rand(1,10),
                'printer'        => 'impresora cocina',
                'name'           => 'Menu '.$i,
                'sub_total'      => 20.50,
                'igv'            => 4.50,
                'total'          => 25.00,
                'state'          => 'A',
                'shop_id'        => rand(1,2)
            ]);
        }
    }
}
