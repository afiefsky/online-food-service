<?php

use Illuminate\Database\Seeder;
use OFS\Entities\Role;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('users_roles')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        for ($i=2; $i<=3; $i++) {
            DB::table('users_roles')->insert([
                'user_id' => $i,
                'role_id' => 2,
            ]);
        }

        for ($i=4; $i<=5; $i++) {
            DB::table('users_roles')->insert([
                'user_id' => $i,
                'role_id' => 3,
            ]);
        }

        for ($i=6; $i<=7; $i++) {
            DB::table('users_roles')->insert([
                'user_id' => $i,
                'role_id' => 4,
            ]);
        }
    }
}
