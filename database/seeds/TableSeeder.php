<?php

use App\Models\Floor;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['A','I'];
        $arrayStatus = ['L','O'];
        $floors = Floor::get();
        foreach ($floors as $key => $floor) {
            for ($i=0; $i < 8; $i++) { 
                $floor->tables()->Create([
                    'name'   => 'Mesa 0'.$i,
                    'state'  => $array[array_rand($array, 1)],
                    'status' => 'L'
                ]);     
            }
        }
    }
}
