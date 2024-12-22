<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Alex',
                'email' => 'a@a.ru',
                'password' => bcrypt('1'),
                'contacts' => 'dghdfhdf'
            ],
        ];
        DB::table('users')->insert($users);
    }
}
