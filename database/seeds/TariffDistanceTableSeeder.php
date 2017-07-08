<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TariffDistanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tariff_distance')->insert([
            'distance' => 1,
            'price' => 5000,
            'is_valid' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'invalid_at' => Carbon::now(),
        ]);

        DB::table('tariff_distance')->insert([
            'distance' => 1,
            'price' => 6000,
            'is_valid' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
