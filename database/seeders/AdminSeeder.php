<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Administrator',
            'email' => 'superadministrador@gmail.com',
            'password' => bcrypt('superadministrador')
        ])->assignRole('superadmin');
    }
}
