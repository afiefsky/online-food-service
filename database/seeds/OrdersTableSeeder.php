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
                'distance_took' => 2,
                'tariff_distance_id' => 1,
                'delivery_status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $c--;
        }

        DB::table('orders')->insert([
            'customer_id' => 1,
            'courier_id' => 1,
            'distance_took' => 7,
            'tariff_distance_id' => 2,
            'delivery_status' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
