<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles_permissions')->insert([
            [
                'roles_id' => '1',
                'permissions_id' => '1',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'roles_id' => '1',
                'permissions_id' => '2',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'roles_id' => '1',
                'permissions_id' => '3',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'roles_id' => '1',
                'permissions_id' => '4',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'roles_id' => '3',
                'permissions_id' => '1',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'roles_id' => '3',
                'permissions_id' => '2',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'roles_id' => '3',
                'permissions_id' => '3',
                'created_by' => 'Add by Seeder'
            ]
        ]);
    }
}
