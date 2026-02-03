<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'RRHH', 'guard_name' => 'web']);
        Role::create(['name' => 'Bienestar', 'guard_name' => 'web']);
        Role::create(['name' => 'Gerencia', 'guard_name' => 'web']);
    }
}