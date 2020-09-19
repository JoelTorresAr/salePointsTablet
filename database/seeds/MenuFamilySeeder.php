<?php

use App\Models\MenuFamily;
use Illuminate\Database\Seeder;

class MenuFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            MenuFamily::create([
                'name'   => 'Familia '.$i,
                'state'  => 'A'
            ]);
            
        }
    }
}
