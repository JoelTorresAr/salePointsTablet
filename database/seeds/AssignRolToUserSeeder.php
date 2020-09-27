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
        $user = User::select('id')->where('id',1)->first();
        $user->assignRoles('mozo');
        $user = User::select('id')->where('id',2)->first();
        $user->assignRoles('mozo');
    }
}
