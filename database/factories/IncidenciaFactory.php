<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incidencia>
 */
class IncidenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estado' => fake()->randomElement(array('Incidencia','Solucionado','Pendiente','Suspendido')),
            'nivel' => fake()->randomElement(array('Urgente','No urgente')),
            // 'ip' => str_pad(fake()->ipv4(), STR_PAD_LEFT),
            'descripcion' => fake()->text(),
            'evidencia' => 'URL: '.fake()->colorName(),
            'equipo_id' => fake()->numberBetween(1,20),
            'user_id' => fake()->numberBetween(1,2),
            'etiqueta_id' => fake()->numberBetween(1,5),
        ];
    }
}
