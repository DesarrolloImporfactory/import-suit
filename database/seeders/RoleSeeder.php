<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{

    public function run()
    {
        $admin = Role::create(['name' => 'Admin']);
        $client = Role::create(['name' => 'Client']);
        $especialista = Role::create(['name' => 'Especialista']);
        $alumno = Role::create(['name' => 'Alumno']);

        Permission::create(['name' => 'admin.dashboard', 'description' => 'Administrar sistema general'])->syncRoles(['Admin']);
        Permission::create(['name' => 'admin.users.index', 'description' => 'Administrar modulo usuarios'])->syncRoles(['Admin']);
        Permission::create(['name' => 'admin.dashboard.index', 'description' => 'Administrar modulo Dashboard'])->syncRoles(['Admin']);
    }
}
