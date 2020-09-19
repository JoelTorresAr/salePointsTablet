<?php

use App\Models\Business;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$business = Business::select('id')->where('ruc', '12345678921')->firstOrFail();
        $business =  Business::select('id')->firstOrFail();
        for ($i = 0; $i < 2; $i++) {
            $business->shops()->Create([
                'name'        => 'shop '.$i,
                'ruc'         => '4563217896'.$i,
                'telephone'   => '741852963',
                'address'     => 'Av. Prueba 12'.$i,
                'email'       => 'shop'.$i.'@hotmail.com',
                'state'      => 'A'
            ]);
        }
    }
}
