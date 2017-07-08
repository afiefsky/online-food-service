<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class MealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $display_name = $faker->sentence($nbWords = 2, $variableNbWords = true);
        $lowerCaseName = strtolower($display_name);
        $noSpaceName = str_replace(' ', '_', $lowerCaseName);

        DB::table('meals')->insert([
            'name' => 'ayam_penyet',
            'display_name' => 'Ayam Penyet',
            'img_url' => $faker->imageUrl($width = 640, $height = 480, 'food'),
            'vendor_id' => 1,
            'meal_type_id' => 1,
            'is_available' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('meals')->insert([
            'name' => 'avocado_juice',
            'display_name' => 'Avocado Juice',
            'img_url' => $faker->imageUrl($width = 640, $height = 480, 'food'),
            'vendor_id' => 2,
            'meal_type_id' => 4,
            'is_available' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
