<?php

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create([
            'ruc' => '12345678921',
            'social_reason' => 'Parillas y carnes S.A.',
            'telephone' => '123456789',
            'email' =>  'prueba@hotmail.com',
            'fiscal_address' => 'Av. Prueba #123',
            'commercial_address' => 'Av. Prueba #321',
            'state' => 'A',
        ]);
    }
}
