<?php

use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('vendors')->truncate();

        for ($i=0; $i<=1; $i++) {
            DB::table('vendors')->insert([
                'name' => $faker->company(),
                'address' => $faker->streetAddress(),
                'phone' => '021' . '-' .$faker->numberBetween($min = 00, $max = 99) . '-' . $faker->numberBetween($min = 000, $max = 999),
                'logo_url' => $faker->imageUrl($width = 640, $height = 480, 'technics'),
            ]);
        }
    }
}
