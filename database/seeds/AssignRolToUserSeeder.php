<?php

use App\User;
use Illuminate\Database\Seeder;

class AssignRolToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::select('id')->first();
        $user->assignRoles('mozo');
    }
}
