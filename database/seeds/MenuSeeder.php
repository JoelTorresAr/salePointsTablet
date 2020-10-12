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

        $menu_families = ['CEVICHES', 'LECHES Y CHILCANOS', 'RONDAS MARINAS', 'FRITURAS', 'JALEAS', 'TIRADITOS', 'ARROCES', 'PARIHUELAS', 'SUDADOS', 'CHICHARRONES', 'GUARNICIONES', 'BEBIDAS', 'C. CRIOLLA'];
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
                'name'      => 'Ciclon norteño (c/ crema de rocoto)',
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
        ];
        $CHILCANOS = [
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
                'name'      => 'Leche de pantera',
                'sub_total' => 18,
                'igv'       => 0,
                'total'     => 18,
            ],
            [
                'name'      => 'Leche de tigre',
                'sub_total' => 15,
                'igv'       => 0,
                'total'     => 15,
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
        ];
        $RONDAS = [
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
        ];
        $FRITURAS = [
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
        ];
        $JALEAS = [
            [
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
        $TIRADITOS = [
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
                'name'      => 'Chicha morada',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Chicha de jora',
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
        ];
        $CRIOLLAS = [
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
                'shop_id'        => 1
            ]);
        }
        foreach ($CHILCANOS as $key => $value) {
            Menu::create([
                'menu_family_id' => 2,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($RONDAS as $key => $value) {
            Menu::create([
                'menu_family_id' => 3,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($FRITURAS as $key => $value) {
            Menu::create([
                'menu_family_id' => 4,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($JALEAS as $key => $value) {
            Menu::create([
                'menu_family_id' => 5,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($TIRADITOS as $key => $value) {
            Menu::create([
                'menu_family_id' => 6,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($ARROCES as $key => $value) {
            Menu::create([
                'menu_family_id' => 7,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($PARIHUELAS as $key => $value) {
            Menu::create([
                'menu_family_id' => 8,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($SUDADOS as $key => $value) {
            Menu::create([
                'menu_family_id' => 9,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($CHICHARRONES as $key => $value) {
            Menu::create([
                'menu_family_id' => 10,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($GUARNICIONES as $key => $value) {
            Menu::create([
                'menu_family_id' => 11,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($BEBIDAS as $key => $value) {
            Menu::create([
                'menu_family_id' => 12,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }
        foreach ($CRIOLLAS as $key => $value) {
            Menu::create([
                'menu_family_id' => 13,
                'printer'        => 'cocina',
                'name'           => $value['name'],
                'sub_total'      => $value['sub_total'],
                'igv'            => $value['igv'],
                'total'          => $value['total'],
                'shop_id'        => 1
            ]);
        }

        /*
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
            */
    }
}
