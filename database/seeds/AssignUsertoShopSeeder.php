<?php

use App\Models\Shop;
use App\User;
use Illuminate\Database\Seeder;

class AssignUsertoShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 4; $i++) {
            $user =  User::select('id', 'name')->where('id', $i)->first();
            $shop = Shop::select('id')->first();
            $shop->users()->attach($user);
        }
    }
}
