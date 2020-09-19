<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'        => 'GERENTE GENERAL',
            'slug'        => 'gerente.g',
            'description' => 'El que paga',
            'special'     => 'all-access'
        ]);
        Role::create([
            'name' => 'SUPERVISOR',
            'slug' => 'supervisor',
            'description' => 'El que supervisa'
        ]);
        Role::create([
            'name' => 'ADMINISTRADOR',
            'slug' => 'administrador',
            'description' => 'El que administra'
        ]);
        Role::create([
            'name' => 'MOZO',
            'slug' => 'mozo',
            'description' => 'El que mozea',
            'special' => 'no-access'
        ]);
        Role::create([
            'name' => 'CAJERA',
            'slug' => 'cajera',
            'description' => 'El que cajea'
        ]);
    }
}
