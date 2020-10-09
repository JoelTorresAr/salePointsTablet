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
        for ($i = 1; $i < 3; $i++) {
            $user = User::select('id')->where('id', $i)->first();
            $user->assignRoles('mozo');
        }
        $user = User::select('id')->where('id', 3)->first();
        $user->assignRoles('administrador');
    }
}
