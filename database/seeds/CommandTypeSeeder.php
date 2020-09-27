<?php

use App\Models\CommandType;
use Illuminate\Database\Seeder;

class CommandTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommandType::create([
            'name' => 'MESAS'
        ]);
        CommandType::create([
            'name' => 'LLEVAR'
        ]);
        CommandType::create([
            'name' => 'DELIVERY'
        ]);
    }
}
