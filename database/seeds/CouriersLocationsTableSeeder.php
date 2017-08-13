<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CouriersLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1 - invalid location since there's new location
        DB::table('couriers_locations')->insert([
            'courier_id' => 1,
            'latitude' => -6.893300,
            'longitude' => 107.584860,
            'is_valid' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'invalid_at' => Carbon::now()
        ]);

        // 2
        DB::table('couriers_locations')->insert([
            'courier_id' => 1,
            'latitude' => -6.885983,
            'longitude' => 107.580665,
            'is_valid' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'invalid_at' => null
        ]);

        DB::table('couriers_locations')->insert([
            'courier_id' => 2,
            'latitude' => -6.877471,
            'longitude' => 107.572420,
            'is_valid' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'invalid_at' => null
        ]);
    }
}
