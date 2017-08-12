<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UsersTableSeeder::class);
        $this->call(VendorsTableSeeder::class);
        $this->call(UsersVendorsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersRolesTableSeeder::class);
        $this->call(UsersCustomersTableSeeder::class);
        $this->call(UsersCouriersTableSeeder::class);
        $this->call(TariffDistanceTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(CancellationsTableSeeder::class);
        $this->call(MealsTypesTableSeeder::class);
        $this->call(MealsTableSeeder::class);
        $this->call(MealsPricesTableSeeder::class);
        $this->call(OrdersDetailsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
    }
}
