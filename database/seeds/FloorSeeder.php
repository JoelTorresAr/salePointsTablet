<?php

use App\Models\CashBox;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cashBox = CashBox::select('id')->firstOrFail();
        for ($i = 0; $i < 5; $i++) {
            $cashBox->floors()->Create([
                'name'    => 'PISO '.$i,
                'printer' => 'printerOne',
                'state'   => 'A'
            ]);
        }
    }
}
