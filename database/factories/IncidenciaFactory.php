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
            'descripcion' => fake()->text(),
            'evidencia' => fake()->imageUrl(),
            'equipo_id' => fake()->numberBetween(1,20),
            'user_id' => fake()->numberBetween(3,12),
            'etiqueta_id' => fake()->numberBetween(1,5),
        ];
    }
}
