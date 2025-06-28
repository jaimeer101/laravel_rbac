<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'roles_code' => 'admin',
                'roles_name' => 'Administrator',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'roles_code' => 'user',
                'roles_name' => 'Users',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'roles_code' => 'moderator',
                'roles_name' => 'Moderator',
                'created_by' => 'Add by Seeder'
            ]
        ]);
    }
}
