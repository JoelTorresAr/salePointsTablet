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
            'social_reason' => 'Che Limon',
            'telephone' => '902588583',
            'email' =>  'prueba@hotmail.com',
            'fiscal_address' => 'Diego Ferre #285',
            'commercial_address' => 'Diego Ferre #285',
            'state' => 'A',
        ]);
    }
}
