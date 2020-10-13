<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BusinessSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(AssignUsertoShopSeeder::class);
        $this->call(CashBoxSeeder::class);
        $this->call(FloorSeeder::class);
        $this->call(AssignRolToUserSeeder::class);
        $this->call(MenuFamilySeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(TableSeeder::class);
        $this->call(ArchingSeeder::class);
     //   $this->call(OpeningSeeder::class);
        $this->call(CommandTypeSeeder::class);
    }
}
