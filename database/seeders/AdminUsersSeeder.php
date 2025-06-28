<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'username' => 'admin', 
            'password'=> bcrypt('password'),
            'roles_id' => '1',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
