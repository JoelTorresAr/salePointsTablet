<?php

use App\Models\Business;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
        $business->users()->Create([
            'name'        => 'MOZO 1',
            'password'    => 'prueba',
            'pin'         => '1234',
            'state'      => 'A'
        ]);
        $business->users()->Create([
            'name'        => 'MOZO 2',
            'pin'         => '5454',
            'state'      => 'A'
        ]);
        $business->users()->Create([
            'name'        => 'ADMINISTRADOR',
            'pin'         => '6666',
            'state'      => 'A'
        ]);
    }
}
