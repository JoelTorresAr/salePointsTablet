<?php

use App\Models\Opening;
use Illuminate\Database\Seeder;

class OpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Opening::create([
           'cash_box_id'                => 1,
           'opening_user'               => 1,
           'opening_amount'             => 300,
           'previous_closing_amount'    => 100,
           'opening_arching_id'         => 1,
           'state'                      => 'A'
       ]); 
    }
}
