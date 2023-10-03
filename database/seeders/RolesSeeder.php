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
        $administrador = Role::create(['name' => 'administrador']);
        $practicante = Role::create(['name' => 'practicante']);
        Role::create(['name' => 'tecnico']);
        Role::create(['name' => 'invitado']);

        Permission::create(['name' => 'incidencia index']);
        Permission::create(['name' => 'incidencia resolver']);      
        Permission::create(['name' => 'user index']);
        Permission::create(['name' => 'user create']);
        Permission::create(['name' => 'user update']);
        Permission::create(['name' => 'user delete']);
        
        Permission::create(['name' => 'etiqueta index']);
        Permission::create(['name' => 'etiqueta create']);
        Permission::create(['name' => 'etiqueta update']);
        Permission::create(['name' => 'etiqueta delete']);

        Permission::create(['name' => 'rol index']);
        Permission::create(['name' => 'rol create']);
        Permission::create(['name' => 'rol update']);
        Permission::create(['name' => 'rol delete']);

        Permission::create(['name' => 'permiso index']);
        Permission::create(['name' => 'permiso create']);
        Permission::create(['name' => 'permiso update']);
        Permission::create(['name' => 'permiso delete']);

        Permission::create(['name' => 'sede index']);
        Permission::create(['name' => 'sede create']);
        Permission::create(['name' => 'sede update']);
        Permission::create(['name' => 'sede delete']);

        Permission::create(['name' => 'oficina index']);
        Permission::create(['name' => 'oficina create']);
        Permission::create(['name' => 'oficina update']);
        Permission::create(['name' => 'oficina delete']);
        
        Permission::create(['name' => 'equipo index']);
        Permission::create(['name' => 'equipo create']);
        Permission::create(['name' => 'equipo update']);
        Permission::create(['name' => 'equipo delete']);
        
        $permission = Permission::all();
        $role1->syncPermissions($permission);

        $practicante->permissions()->attach([1,2]);
        $administrador->syncPermissions($permission);

    }
}
