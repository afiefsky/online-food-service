<?php

use Illuminate\Database\Seeder;

class UsersCustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=6; $i<=7; $i++) {
            DB::table('users_customers')->insert([
                'user_id' => $i,
                'is_active' => 1,
            ]);
        }
    }
}
