<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'First',
            'email' => 'first@domain.com',
            'password' => Hash::make('password')
        ]);

        DB::table('users')->insert([
            'name' => 'Second',
            'email' => 'second@domain.com',
            'password' => Hash::make('password')
        ]);
    }
}
