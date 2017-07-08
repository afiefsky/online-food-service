<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CancellationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('cancellations')->insert([
            'order_id' => 3,
            'reason' => $faker->sentence($nbWords = 9, $variableNbWords = true),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
