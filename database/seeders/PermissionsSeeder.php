<?php

namespace Database\Seeders;


use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'permissions_code' => 'create',
                'permissions_name' => 'Create',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'permissions_code' => 'read',
                'permissions_name' => 'Read',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'permissions_code' => 'update',
                'permissions_name' => 'Update',
                'created_by' => 'Add by Seeder'
            ], 
            [
                'permissions_code' => 'delete',
                'permissions_name' => 'Delete',
                'created_by' => 'Add by Seeder'
            ]
        ]);
    }
}
