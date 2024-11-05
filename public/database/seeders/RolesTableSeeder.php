<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'apprenant',
            'visiteur',
            'superadmin',
         ];
         
         foreach ($roles as $role) {
              Role::create(['name' => $role]);
         }
     }
    }