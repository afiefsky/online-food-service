<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrdersDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders_details')->insert([
            'order_id' => 1,
            'meal_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('orders_details')->insert([
            'order_id' => 1,
            'meal_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('orders_details')->insert([
            'order_id' => 2,
            'meal_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('orders_details')->insert([
            'order_id' => 3,
            'meal_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
