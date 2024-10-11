<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete'
         ];
         
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
     }
}

