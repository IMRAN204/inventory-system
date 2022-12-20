<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'admin',
            'email'=> 'admin@test.com',
            'role_id' => 1,
            'password'=> bcrypt('admin123')
        ]);

        DB::table('users')->insert([
            'name'=> 'imran',
            'email'=> 'imran@test.com',
            'role_id' => 2,
            'password'=> bcrypt('imran123')
        ]);
    }
}
