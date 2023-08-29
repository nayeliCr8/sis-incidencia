<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'administrador']);
        Role::create(['name' => 'practicante']);
        Role::create(['name' => 'tecnico']);
        Role::create(['name' => 'invitado']);

        Permission::create(['name' => 'user index']);
        Permission::create(['name' => 'user create']);
        Permission::create(['name' => 'user update']);
        Permission::create(['name' => 'user delete']);
        Permission::create(['name' => 'etiqueta index']);
        Permission::create(['name' => 'etiqueta create']);
        Permission::create(['name' => 'etiqueta update']);
        Permission::create(['name' => 'etiqueta delete']);

        $permission = Permission::all();
        $role1->syncPermissions($permission);
    }
}
