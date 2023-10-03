<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RolesSeeder::class, AdminSeeder::class]);
        \App\Models\User::factory()->create([
            'name' => 'Joel_admin',
            'email' => 'administrador@gmail.com',
            'password' => bcrypt('administrador@gmail.com')
        ])->assignRole('administrador');
        \App\Models\User::factory()->create([
            'name' => 'Joel_practicante',
            'email' => 'practicante@gmail.com',
            'password' => bcrypt('practicante')
        ])->assignRole('practicante');
        \App\Models\User::factory()->create([
            'name' => 'Joel_invitado',
            'email' => 'invitado@gmail.com',
            'password' => bcrypt('invitado')
        ])->assignRole('invitado');
        \App\Models\User::factory(10)->create(); //->assignRole('invitado');
        \App\Models\Etiqueta::factory(5)->create();
        \App\Models\Sede::factory(5)->create();
        \App\Models\Oficina::factory(30)->create();
        \App\Models\Perfil::factory(12)->create();
        \App\Models\Equipo::factory(100)->create();
        \App\Models\Incidencia::factory(500)->create();
    }
}
