<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MealsPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meals_prices')->insert([
            'meal_id' => 1,
            'price' => 15000,
            'is_valid' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('meals_prices')->insert([
            'meal_id' => 2,
            'price' => 9000,
            'is_valid' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'invalid_at' => Carbon::now(),
        ]);

        DB::table('meals_prices')->insert([
            'meal_id' => 2,
            'price' => 9500,
            'is_valid' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('meals_prices')->insert([
            'meal_id' => 3,
            'price' => 11000,
            'is_valid' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
