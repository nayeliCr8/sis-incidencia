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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Administrator',
        //     'email' => 'administrador@gmail.com',
        //     'password' => bcrypt('administrador')
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Joel_admin',
            'email' => 'test@gmail.com',
            'password' => bcrypt('test@gmail.com')
        ]);

        $this->call([RolesSeeder::class, AdminSeeder::class]);
        \App\Models\Etiqueta::factory(5)->create();
        \App\Models\Sede::factory(10)->create();
        \App\Models\Oficina::factory(30)->create();
        \App\Models\Equipo::factory(50)->create();
        \App\Models\Incidencia::factory(50)->create();
    }
}
