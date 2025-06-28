<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Normal User',
            'email' => 'user@admin.com',
            'username' => 'user1', 
            'password'=> bcrypt('12345'),
            'roles_id' => '2',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
