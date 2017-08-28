<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = 2;
        for ($i=1; $i<=2; $i++) {
            DB::table('orders')->insert([
                'customer_id' => $i,
                'courier_id' => $c,
                'meal_id' => 1,
                'qty' => 2,
                'tariff' => 2000,
                'notes' => 'Notes A',
                'delivery_status' => '3',
                'total' => 32000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $c--;
        }

        DB::table('orders')->insert([
            'customer_id' => 1,
            'courier_id' => 1,
            'meal_id' => 2,
            'qty' => 1,
            'tariff' => 2000,
            'notes' => 'Notes B',
            'delivery_status' => '0',
            'total' => 11000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
