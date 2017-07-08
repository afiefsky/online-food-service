<?php

use Illuminate\Database\Seeder;
use OFS\Entities\User;
use OFS\Entities\Vendor;

class UsersVendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=2; $i<=6; $i=$i+2) {
            DB::table('users_vendors')->insert([
                'user_id' => $i,
                'vendor_id' => 1,
            ]);
        }

        for ($i=3; $i<=7; $i=$i+2) {
            DB::table('users_vendors')->insert([
                'user_id' => $i,
                'vendor_id' => 2,
            ]);
        }
    }
}
