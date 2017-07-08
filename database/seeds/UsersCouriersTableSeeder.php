<?php

use Illuminate\Database\Seeder;

class UsersCouriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=4; $i<=5; $i++) {
            DB::table('users_couriers')->insert([
                'user_id' => $i,
                'is_active' => 1,
            ]);
        }
    }
}
