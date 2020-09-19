<?php

use App\Models\Shop;
use Illuminate\Database\Seeder;

class CashBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shop = Shop::select('id')->firstOrFail();

        $shop->cashBoxes()->Create([
            'name'            => 'CAJA 1',
            'printer_name'    => 'nombre de impresora',
            'state'           => 'A'
        ]);
    }
}
