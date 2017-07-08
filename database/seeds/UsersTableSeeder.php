<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('users')->truncate();

        DB::table('users')->insert([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@ofs.com',
            'password' => bcrypt('nothing'),
            'phone' => '',
            'avatar_url' => $faker->imageUrl($width = 640, $height = 480, 'people'),
        ]);

        for ($i=1; $i<=2; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => 'admin@vendor' . $i . '.com',
                'password' => bcrypt('nothing'),
                'phone' => '+62' . '-' . '8' .$faker->numberBetween($min = 00, $max = 99) . '-' . $faker->numberBetween($min = 000, $max = 999) . '-' . $faker->numberBetween($min = 000, $max = 999),
                'avatar_url' => $faker->imageUrl($width = 640, $height = 480, 'people'),
            ]);
        }

        for ($i=1; $i<=2; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => 'courier@vendor' . $i . '.com',
                'password' => bcrypt('nothing'),
                'phone' => '+62' . '-' . '8' .$faker->numberBetween($min = 00, $max = 99) . '-' . $faker->numberBetween($min = 000, $max = 999) . '-' . $faker->numberBetween($min = 000, $max = 999),
                'avatar_url' => $faker->imageUrl($width = 640, $height = 480, 'people'),
            ]);
        }

        for ($i=1; $i<=2; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => 'customer@vendor' . $i . '.com',
                'password' => bcrypt('nothing'),
                'phone' => '+62' . '-' . '8' .$faker->numberBetween($min = 00, $max = 99) . '-' . $faker->numberBetween($min = 000, $max = 999) . '-' . $faker->numberBetween($min = 000, $max = 999),
                'avatar_url' => $faker->imageUrl($width = 640, $height = 480, 'people'),
            ]);
        }
    }
}
