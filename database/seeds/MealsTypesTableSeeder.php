<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MealsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $display_name = $faker->sentence($nbWords = 2, $variableNbWords = true);
        $lowerCaseName = strtolower($display_name);
        $noSpaceName = str_replace(' ', '_', $lowerCaseName);

        DB::table('meals_types')->insert([
            'name' => 'meat',
            'display_name' => 'Meat',
            'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'icon_url' => $faker->imageUrl($width = 640, $height = 480, 'food'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('meals_types')->insert([
            'name' => 'vegetable',
            'display_name' => 'Vegetable',
            'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'icon_url' => $faker->imageUrl($width = 640, $height = 480, 'food'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('meals_types')->insert([
            'name' => 'hot_drink',
            'display_name' => 'Hot Drink',
            'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'icon_url' => $faker->imageUrl($width = 640, $height = 480, 'food'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('meals_types')->insert([
            'name' => 'fresh_drink',
            'display_name' => 'Fresh Drink',
            'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'icon_url' => $faker->imageUrl($width = 640, $height = 480, 'food'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('meals_types')->insert([
            'name' => 'egg_and_egg_product',
            'display_name' => 'Egg and Egg Product',
            'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'icon_url' => $faker->imageUrl($width = 640, $height = 480, 'food'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
