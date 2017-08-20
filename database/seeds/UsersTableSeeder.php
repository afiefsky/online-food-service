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
            'birthplace' => 'Unknown',
            'birthdate' => '1990-01-01',
            'gender' => 'M',
            'email' => 'superadmin@ofs.com',
            'password' => bcrypt('nothing'),
            'phone' => '',
            'avatar_url' => $faker->imageUrl($width = 640, $height = 480, 'people'),
            'category_id' => 1, // Super Admin,
            'category_number' => 0000
        ]);

        for ($i=1; $i<=2; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'birthplace' => 'Jakarta',
                'birthdate' => '1979-11-2' . $i,
                'gender' => 'F',
                'email' => 'admin@vendor' . $i . '.com',
                'password' => bcrypt('nothing'),
                'phone' => '+62' . '-' . '8' .$faker->numberBetween($min = 00, $max = 99) . '-' . $faker->numberBetween($min = 000, $max = 999) . '-' . $faker->numberBetween($min = 000, $max = 999),
                'avatar_url' => $faker->imageUrl($width = 640, $height = 480, 'people'),
                'category_id' => 3, // Pegawai
                'category_number' => 4004001 . $i
            ]);
        }

        for ($i=1; $i<=2; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'birthplace' => 'Cirebon',
                'birthdate' => '1995-02-2' . ($i+1),
                'gender' => 'M',
                'email' => 'courier@vendor' . $i . '.com',
                'password' => bcrypt('nothing'),
                'phone' => '+62' . '-' . '8' .$faker->numberBetween($min = 00, $max = 99) . '-' . $faker->numberBetween($min = 000, $max = 999) . '-' . $faker->numberBetween($min = 000, $max = 999),
                'avatar_url' => $faker->imageUrl($width = 640, $height = 480, 'people'),
                'category_id' => 2, // Mahasiswa
                'category_number' => 114301 . $i
            ]);
        }

        for ($i=1; $i<=2; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'birthplace' => 'Bandung',
                'birthdate' => '1985-12-2' . ($i+2),
                'gender' => 'F',
                'email' => 'customer@vendor' . $i . '.com',
                'password' => bcrypt('nothing'),
                'phone' => '+62' . '-' . '8' .$faker->numberBetween($min = 00, $max = 99) . '-' . $faker->numberBetween($min = 000, $max = 999) . '-' . $faker->numberBetween($min = 000, $max = 999),
                'avatar_url' => $faker->imageUrl($width = 640, $height = 480, 'people'),
                'category_id' => 3, // Pegawai
                'category_number' => 5005001 . $i
            ]);
        }
    }
}
