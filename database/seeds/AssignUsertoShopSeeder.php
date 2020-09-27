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
        $user =  User::select('id','name')->where('id',1)->first();
        $shop = Shop::select('id')->first();

        $shop->users()->attach($user);
        $user =  User::select('id','name')->where('id',2)->first();
        $shop->users()->attach($user);

    }
}
