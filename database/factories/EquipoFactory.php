<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marca' => 'Marca '.fake()->colorName(),
            'serie' => 'Serie '.fake()->colorName(),
            'ip' => str_pad(fake()->ipv4(), STR_PAD_LEFT),
            'observacion' => fake()->text(),
            'estado' => fake()->randomElement(array('Pesimo','Regular', 'Bueno','Excelente')),
            'tipo_equipo' => 'Equipo '.fake()->company(),
            'oficina_id' => fake()->numberBetween(1,20),
        ];
    }
}
