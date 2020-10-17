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
        $floor1 = Floor::where('id', 1)->first();
        $floor2 = Floor::where('id', 2)->first();
        for ($i = 1; $i < 61; $i++) {
            if ($i < 46) {
                $floor1->tables()->Create([
                    'name'   => 'Mesa ' . $i,
                    'state'  => 'A',
                    'status' => 'L'
                ]);
            } else {
                $floor2->tables()->Create([
                    'name'   => 'Mesa ' . $i,
                    'state'  => 'A',
                    'status' => 'L'
                ]);
            }
        }
    }
}
