<?php

use App\Models\Arching;
use Illuminate\Database\Seeder;

class ArchingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Arching::create([
            'total' => 300
        ]);
    }
}
