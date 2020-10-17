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
                'name'      => 'Mixto de 25',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Mixto de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Mixto de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Mixto de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Conchas negras de 25',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Conchas negras de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Conchas negras de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Tollo de 20',
                'sub_total' => 20,
                'igv'       => 0,
                'total'     => 20,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Tollo de 25',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Tollo de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Caballa de 20',
                'sub_total' => 20,
                'igv'       => 0,
                'total'     => 20,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Caballa de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Caballa de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Caballa de 25',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
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
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
            ],
            [
                'name'      => 'Tiradito al  limón',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
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
                'name'      => 'Reconciliadora de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Reconciliadora de 50',
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
                'name'      => 'Cabrilla de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
            ],
            [
                'name'      => 'Cabrilla de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Cabrilla de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Cabrilla de 45',
                'sub_total' => 45,
                'igv'       => 0,
                'total'     => 45,
            ],
            [
                'name'      => 'Cabrilla de 50',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cabrilla de 60',
                'sub_total' => 60,
                'igv'       => 0,
                'total'     => 60,
            ],
            [
                'name'      => 'Congrio de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
            ],
            [
                'name'      => 'Congrio de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Congrio de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Congrio de 45',
                'sub_total' => 45,
                'igv'       => 0,
                'total'     => 45,
            ],
            [
                'name'      => 'Congrio de 50',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Congrio de 60',
                'sub_total' => 60,
                'igv'       => 0,
                'total'     => 60,
            ],
            [
                'name'      => 'Tollo de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Tollo de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Tollo de 45',
                'sub_total' => 45,
                'igv'       => 0,
                'total'     => 45,
            ],
            [
                'name'      => 'Tollo familiar de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Tollo familiar de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Tollo familiar de 45',
                'sub_total' => 45,
                'igv'       => 0,
                'total'     => 45,
            ],
            [
                'name'      => 'Tollo familiar de 50',
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
                'name'      =>  'Clasico chilcano',
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
                'name'      => 'Ciclon norteño de 25',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Ciclon norteño de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
                'shop_id'   => 1
            ],
            [
                'printer'   => 'cocina',
                'name'      => 'Ciclon norteño de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
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
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
            ],
            [
                'name'      => 'Tollo en trozos',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
            ],
            [
                'name'      => 'Tollo en trozos',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
        ];
        $ARROCES = [
            [
                'name'      => 'Arroz con mariscos de 25',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
            ],
            [
                'name'      => 'Arroz con mariscos de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
            ],
            [
                'name'      => 'Arroz con mariscos de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Arroz con mariscos de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Arroz con mariscos de 50',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz con langostinos de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Arroz con langostinos de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Arroz con langostinos de 50',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz con conchas negras de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Arroz con conchas negras de 50',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Arroz chaufa de mariscos de 25',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
            ],
            [
                'name'      => 'Arroz chaufa de mariscos 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
            ],
            [
                'name'      => 'Arroz chaufa de mariscos de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Arroz chaufa de tollo de 20',
                'sub_total' => 20,
                'igv'       => 0,
                'total'     => 20,
            ],
            [
                'name'      => 'Arroz chaufa de tollo de 25',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
            ],
            [
                'name'      => 'Arroz chaufa de tollo de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
            ],
            [
                'name'      => 'Arroz chaufa de tollo de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Arroz chaufa de tollo de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
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
                'name'      => 'Cabrilla mixta de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Cabrilla mixta de 45',
                'sub_total' => 45,
                'igv'       => 0,
                'total'     => 45,
            ],
            [
                'name'      => 'Cabrilla mixta de 50',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Cabrilla mixta de 60',
                'sub_total' => 60,
                'igv'       => 0,
                'total'     => 60,
            ],
            [
                'name'      => 'Congrio mixto de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Congrio mixto de 45',
                'sub_total' => 45,
                'igv'       => 0,
                'total'     => 45,
            ],
            [
                'name'      => 'Congrio mixto de 50',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Congrio mixto de 60',
                'sub_total' => 60,
                'igv'       => 0,
                'total'     => 60,
            ],
            [
                'name'      => 'Solo cabrilla',
                'sub_total' => 45,
                'igv'       => 0,
                'total'     => 45,
            ],
            [
                'name'      => 'Solo congrio',
                'sub_total' => 45,
                'igv'       => 0,
                'total'     => 45,
            ],
            [
                'name'      => 'Tollo en trozos',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
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
                'name'      => 'Chicharron de langostinos de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Chicharron de langostinos de 50',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Chicharron de tollo de 25',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
            ],
            [
                'name'      => 'Chicharron de tollo de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
            ],
            [
                'name'      => 'Chicharron de tollo de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Chicharron de tollo de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Chicharron de tollo de 50',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
            [
                'name'      => 'Chicharron de pollo de 25',
                'sub_total' => 25,
                'igv'       => 0,
                'total'     => 25,
            ],
            [
                'name'      => 'Chicharron de pollo de 30',
                'sub_total' => 30,
                'igv'       => 0,
                'total'     => 30,
            ],
            [
                'name'      => 'Chicharron de pollo de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Chicharron mixto de 35',
                'sub_total' => 35,
                'igv'       => 0,
                'total'     => 35,
            ],
            [
                'name'      => 'Chicharron mixto de 40',
                'sub_total' => 40,
                'igv'       => 0,
                'total'     => 40,
            ],
            [
                'name'      => 'Chicharron mixto de 50',
                'sub_total' => 50,
                'igv'       => 0,
                'total'     => 50,
            ],
        ];
        $GUARNICIONES = [
            [
                'name'      => 'Choclo frito',
                'sub_total' => 5,
                'igv'       => 0,
                'total'     => 5,
            ],
            [
                'name'      => 'Yuca frita',
                'sub_total' => 5,
                'igv'       => 0,
                'total'     => 5,
            ],
            [
                'name'      => 'Porcion de arroz',
                'sub_total' => 3,
                'igv'       => 0,
                'total'     => 3,
            ],
            [
                'name'      => 'Porcion de chifle',
                'sub_total' => 3,
                'igv'       => 0,
                'total'     => 3,
            ],
            [
                'name'      => 'Porcion de cancha',
                'sub_total' => 3,
                'igv'       => 0,
                'total'     => 3,
            ],
            [
                'name'      => 'Porcion de yucha sancochada',
                'sub_total' => 3,
                'igv'       => 0,
                'total'     => 3,
            ],
            [
                'name'      => 'Porcion de camote',
                'sub_total' => 2.5,
                'igv'       => 0,
                'total'     => 2.5,
            ],
            [
                'name'      => 'Guarnicion de parihuela',
                'sub_total' => 3,
                'igv'       => 0,
                'total'     => 3,
            ],
            [
                'name'      => 'Guarnicion de sudado',
                'sub_total' => 3.5,
                'igv'       => 0,
                'total'     => 3.5,
            ],
        ];
        $BEBIDAS = [
            [
                'name'      => 'Piña',
                'sub_total' => 8,
                'igv'       => 0,
                'total'     => 8,
            ],
            [
                'name'      => 'Lima',
                'sub_total' => 8,
                'igv'       => 0,
                'total'     => 8,
            ],
            [
                'name'      => 'Maracuya',
                'sub_total' => 8,
                'igv'       => 0,
                'total'     => 8,
            ],
            [
                'name'      => 'Cristal',
                'sub_total' => 6.5,
                'igv'       => 0,
                'total'     => 6.5,
            ],
            [
                'name'      => 'Cuzqueña',
                'sub_total' => 8,
                'igv'       => 0,
                'total'     => 8,
            ],
            [
                'name'      => 'Pepsi 3L',
                'sub_total' => 10,
                'igv'       => 0,
                'total'     => 10,
            ],
            [
                'name'      => 'Pepsi 1.5L',
                'sub_total' => 6.5,
                'igv'       => 0,
                'total'     => 6.5,
            ],
            [
                'name'      => 'Pepsi chiki',
                'sub_total' => 2,
                'igv'       => 0,
                'total'     => 2,
            ],
            [
                'name'      => 'Inka Kola 2L',
                'sub_total' => 9,
                'igv'       => 0,
                'total'     => 9,
            ],
            [
                'name'      => 'Inka Kola 1.5L',
                'sub_total' => 8,
                'igv'       => 0,
                'total'     => 8,
            ],
            [
                'name'      => 'Inka Kola 1L',
                'sub_total' => 6,
                'igv'       => 0,
                'total'     => 6,
            ],
            [
                'name'      => 'Inka Kola gordita',
                'sub_total' => 4,
                'igv'       => 0,
                'total'     => 4,
            ],
            [
                'name'      => 'Inka Kola personal',
                'sub_total' => 3,
                'igv'       => 0,
                'total'     => 3,
            ],
            [
                'name'      => 'Coca Cola 2L',
                'sub_total' => 9,
                'igv'       => 0,
                'total'     => 9,
            ],
            [
                'name'      => 'Coca Cola 1.5L',
                'sub_total' => 8,
                'igv'       => 0,
                'total'     => 8,
            ],
            [
                'name'      => 'Coca Cola 1L',
                'sub_total' => 6,
                'igv'       => 0,
                'total'     => 6,
            ],
            [
                'name'      => 'Coca Cola personal',
                'sub_total' => 2.5,
                'igv'       => 0,
                'total'     => 2.5,
            ],
            [
                'name'      => 'Cassinelli',
                'sub_total' => 5,
                'igv'       => 0,
                'total'     => 5,
            ],
            [
                'name'      => 'Sporade',
                'sub_total' => 3,
                'igv'       => 0,
                'total'     => 3,
            ],
            [
                'name'      => 'Agua',
                'sub_total' => 3,
                'igv'       => 0,
                'total'     => 3,
            ],
            [
                'name'      => 'Pulp',
                'sub_total' => 2,
                'igv'       => 0,
                'total'     => 2,
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
