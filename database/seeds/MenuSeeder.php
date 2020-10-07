<?php

use App\Models\Menu;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
           Menu::create([
                'menu_family_id' => 1,
                'printer'        => 'cocina',
                'name'           => '1 POLLO A LA BRASA+PORCION DE PAPAS+PORCION DE ENSALADA+CREMAS',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 1,
                'printer'        => 'cocina',
                'name'           => '1/2 POLLO A LA BRASA+PORCION DE PASAS+PORCION DE ENSALADA+CREMAS',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 1,
                'printer'        => 'cocina',
                'name'           => '1/4 POLLO A LA BRASA+PORCION DE PASAS+PORCION DE ENSALADA+CREMAS',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 1,
                'printer'        => 'cocina',
                'name'           => '1 POLLO A LA BRASA+PORCION DE PASAS+PORCION DE ENSALADA+CREMAS+INKA KOLA 1.5 LITRO',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 1,
                'printer'        => 'cocina',
                'name'           => '1 POLLO A LA BRASA+PORCION DE PASAS+PORCION DE ENSALADA+CREMAS+ PEPSI 1.5 LITRO',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 1,
                'printer'        => 'cocina',
                'name'           => '1/2 POLLO A LA BRASA+PORCION DE PASAS+PORCION DE ENSALADA+CREMAS+GASEOSA 1.5 LITROS',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 1,
                'printer'        => 'cocina',
                'name'           => 'POLLO SOLO',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 2,
                'printer'        => 'cocina',
                'name'           => 'GASEOSA 1.5LT INKA KOLA',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 3,
                'printer'        => 'cocina',
                'name'           => '1 PORCION DE PAPAS',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 3,
                'printer'        => 'cocina',
                'name'           => '1 PORCION DE ARROZ',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 3,
                'printer'        => 'cocina',
                'name'           => '1 PORCION DE ENSALADA',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 3,
                'printer'        => 'cocina',
                'name'           => '1 PORCION DE MOLLEJITAS FRITAS',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 4,
                'printer'        => 'cocina',
                'name'           => '1 PEPSI  DE 500 ML.',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);
           Menu::create([
                'menu_family_id' => 5,
                'printer'        => 'cocina',
                'name'           => 'TAPER PARA POLLO',
                'sub_total'      => 33.89,
                'igv'            => 6.10,
                'total'          => 39.99,
                'state'          => 'A',
                'shop_id'        => 1
            ]);

            DB::table('menu_supply')->insert(
                [
                    'supply_id'      => 1,
                    'menu_id'        => 1,
                    'quantity'       => 4,
                ]
            );
            DB::table('menu_supply')->insert(
                [
                    'supply_id'      => 2,
                    'menu_id'        => 1,
                    'quantity'       => 4,
                ]
            );
            DB::table('menu_supply')->insert(
                [
                    'supply_id'      => 1,
                    'menu_id'        => 2,
                    'quantity'       => 8,
                ]
            );
            DB::table('menu_supply')->insert(
                [
                    'supply_id'      => 2,
                    'menu_id'        => 2,
                    'quantity'       => 7,
                ]
            );
            DB::table('menu_supply')->insert(
                [
                    'supply_id'      => 4,
                    'menu_id'        => 2,
                    'quantity'       => 1,
                ]
            );
    }
}
