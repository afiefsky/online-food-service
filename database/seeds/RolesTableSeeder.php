<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // Super Admin
        DB::table('roles')->insert([
            'name' => 'superadmin',
            'display_name' => 'Super Admin',
            'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'hidden' => 1,
        ]);

        // Administrator
        DB::table('roles')->insert([
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'hidden' => 0,
        ]);

        // Courier
        DB::table('roles')->insert([
            'name' => 'courier',
            'display_name' => 'Courier',
            'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'hidden' => 0,
        ]);

        // Customer
        DB::table('roles')->insert([
            'name' => 'customer',
            'display_name' => 'Customer',
            'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'hidden' => 0,
        ]);
    }
}
