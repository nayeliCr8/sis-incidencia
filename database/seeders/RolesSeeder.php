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

        Permission::create(['name' => 'incidencia index']); //1
        Permission::create(['name' => 'incidencia resolver']); //2     
      
        Permission::create(['name' => 'etiqueta index']); //3
        Permission::create(['name' => 'etiqueta create']); //4 
        Permission::create(['name' => 'etiqueta update']); //5 
        Permission::create(['name' => 'etiqueta delete']); //6 

        Permission::create(['name' => 'sede index']); //7 
        Permission::create(['name' => 'sede create']); //8 
        Permission::create(['name' => 'sede update']); //9 
        Permission::create(['name' => 'sede delete']); //10

        Permission::create(['name' => 'oficina index']); //11
        Permission::create(['name' => 'oficina create']); //12
        Permission::create(['name' => 'oficina update']); //13
        Permission::create(['name' => 'oficina delete']); //14
        
        Permission::create(['name' => 'equipo index']); //15
        Permission::create(['name' => 'equipo create']); //16
        Permission::create(['name' => 'equipo update']); //17    
        Permission::create(['name' => 'equipo delete']); //18

        Permission::create(['name' => 'user index']); //19
        Permission::create(['name' => 'user create']); //20
        Permission::create(['name' => 'user update']); //21
        Permission::create(['name' => 'user delete']); //22
        
        Permission::create(['name' => 'permiso index']); //23
        Permission::create(['name' => 'permiso create']); //24
        Permission::create(['name' => 'permiso update']); //25
        Permission::create(['name' => 'permiso delete']); //26
        
        Permission::create(['name' => 'rol index']); //27
        Permission::create(['name' => 'rol create']); //28
        Permission::create(['name' => 'rol update']); //29
        Permission::create(['name' => 'rol delete']); //30

        $permission = Permission::all();
        $role1->syncPermissions($permission);

        $practicante->permissions()->attach([1,2]);
        $administrador->permissions()->attach([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,27]);

    }
}
