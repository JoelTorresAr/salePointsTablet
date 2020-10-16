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

        $CEVICHES = [
            [
                'printer'   => 'cocina',
                'name'      => 'Ceviche Mi Che Limón',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Mixto personal',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Mixto mediano',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Mixto familiar',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Conchas negras',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Tollo personal',
                'sub_total' => 20,
                'igv'       => 0,
                'total'     => 20,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Tollo mediano',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Tollo familiar',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Caballa (salada y frsca)',
                'sub_total' => 20,
                'igv'       => 0,
                'total'     => 20,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Caballa (salada y frsca)',
                'sub_total' => 20,
                'igv'       => 0,
                'total'     => 20,
                'shop_id'   => 1
            ],
            [
                'name'      => 'Ronda Mi Che',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Trío mi che',
                'sub_total' => 45,
                'igv'       => 0,
                'total'     => 45,
            ],
            [
                'name'      => 'Duo mi che',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Tiradito a la crema amarilla',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Tiradito al  limón',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Leche mi Che Limón',
                'sub_total' => 20,
                'igv'       => 0,
                'total'     => 20,
            ],
            [
                'name'      => 'Leche de cangrejos',
                'sub_total' => 20,
                'igv'       => 0,
                'total'     => 20,
            ],
            [
                'name'      => 'Leche de tigre',
                'sub_total' => 15,
                'igv'       => 0,
                'total'     => 15,
            ],
        ];
        $PARIHUELAS = [
            [
                'name'      => 'Reconciliadora',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Mero',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cabrilla',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Congrio',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Tollo mediano',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Tollo familiar',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
        ];
        $CARTA = [
            [
                'name'      => 'Leche de pantera',
                'sub_total' => 18,
                'igv'       => 0,
                'total'     => 18,
            ],
            [
                'name'      =>  'Clasico chiclano',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
            ],
            [
                'name'      => 'Tollo en zarza',
                'sub_total' => 20,
                'igv'       => 0,
                'total'     => 20,
            ],
            [
                'name'      => 'Batea en zarza',
                'sub_total' => 20,
                'igv'       => 0,
                'total'     => 20,
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Ciclon norteño (c/ crema de rocoto)',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
                'shop_id'   => 1
            ],
            [
                'name'      => 'Cabrilla a lo macho',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cabrilla al ajo',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cabrilla frita',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Carne seca',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Tortilla de raya',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cuy con papas',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Lomo saltado',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz con pato',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cabrito a la chiclayana',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Causa ferreñafana',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],[
                'name'      => 'Señor de sipan',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cabrilla entera',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Royal (filete de tollo)',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Tollo en trozos',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
        ];
        $ARROCES = [
            [
                'name'      => 'Arroz con mariscos personal',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz con mariscos mediano',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz con mariscos familiar',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz con langostinos personal',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz con langostinos mediano',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz con langostinos familiar',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz con conchas negras',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz chaufa de mariscos personal',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz chaufa de mariscos mediana',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz chaufa de mariscos familiar',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz chaufa de tollo personal',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz chaufa de tollo mediana',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz chaufa de tollo familiar',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
        ];
        $SUDADOS = [
            [
                'name'      => 'Sudado de conchas negras',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cabrilla con mariscos personal',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cabrilla con mariscos fuente',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Congrio con mariscos',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Solo cabrilla',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Solo congrio',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Tollo en trozos',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
        ];
        $CHICHARRONES = [
            [
                'name'      => 'Chicharron de mariscos',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Chicharron de langostinos',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Chicharron de tollo personal',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Chicharron de tollo mediano',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Chicharron de tollo familiar',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Chicharron de pollo mediano',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Chicharron de pollo familiar',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Chicharron mixto',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
        ];
        $GUARNICIONES = [
            [
                'name'      => 'Choclo frito',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Yuca frita',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Porcion de arroz',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Porcion de chifle',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Porcion de cancha',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Porcion de yucha sancochada',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Porcion de camote',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Guarnicion de parihuela',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Guarnicion de sudado',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
        ];
        $BEBIDAS = [
            [
                'name'      => 'Piña',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Lima',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Maracuya',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cristal',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cuzqueña',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Pepsi 3L',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Pepsi 1.5L',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Pepsi chiki',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Inka Kola 2L',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Inka Kola 1.5L',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Inka Kola 1L',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Inka Kola gordita',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Inka Kola personal',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Coca Cola 2L',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Coca Cola 1.5L',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Coca Cola 1L',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Coca Cola personal',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cassinelli',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Sporade',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Agua',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Pulp',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
        ];
        $OTROS = [
            [
                'name'      => 'PLATO ROTO',
                'sub_total' => 1,
                'igv'       => 0,
                'total'     => 1,
            ],
            [
                'name'      => 'VASO ROTO',
                'sub_total' => 1,
                'igv'       => 0,
                'total'     => 1,
            ],
            [
                'name'      => 'BOTELLA ROTO',
                'sub_total' => 1,
                'igv'       => 0,
                'total'     => 1,
            ],
            [
                'name'      => 'TAPER',
                'sub_total' => 1,
                'igv'       => 0,
                'total'     => 1,
            ],
        ];
        foreach ($CEVICHES as $key => $value) {
            Menu::create([
                'menu_family_id' => 1,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1,
                'orden'          => 1
            ]);
        }
        foreach ($PARIHUELAS as $key => $value) {
            Menu::create([
                'menu_family_id' => 2,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1,
                'orden'          => 2
            ]);
        }
        foreach ($ARROCES as $key => $value) {
            Menu::create([
                'menu_family_id' => 3,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1,
                'orden'          => 3
            ]);
        }
        foreach ($CHICHARRONES as $key => $value) {
            Menu::create([
                'menu_family_id' => 4,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1,
                'orden'          => 4
            ]);
        }
        foreach ($BEBIDAS as $key => $value) {
            Menu::create([
                'menu_family_id' => 5,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1,
                'orden'          => 5
            ]);
        }
        foreach ($SUDADOS as $key => $value) {
            Menu::create([
                'menu_family_id' => 6,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1,
                'orden'          => 5
            ]);
        }
        foreach ($CARTA as $key => $value) {
            Menu::create([
                'menu_family_id' => 7,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1,
                'orden'          => 5
            ]);
        }
        foreach ($GUARNICIONES as $key => $value) {
            Menu::create([
                'menu_family_id' => 8,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1,
                'orden'          => 5
            ]);
        }
        foreach ($OTROS as $key => $value) {
            Menu::create([
                'menu_family_id' => 9,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1,
                'orden'          => 5
            ]);
        }
    }
}
