<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('categories')->insert([
            'name' => 'Super Admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // 2
        DB::table('categories')->insert([
            'name' => 'Mahasiswa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // 3
        DB::table('categories')->insert([
            'name' => 'Pegawai',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
