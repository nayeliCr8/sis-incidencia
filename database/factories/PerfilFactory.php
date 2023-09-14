<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perfil>
 */
class PerfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'apellidos' => fake()->lastName().' '.fake()->lastName(),
            'celular' => fake()->phoneNumber(),
            'cod_planilla' => fake()->numerify(),
            'oficina_id' => fake()->numberBetween(1,10),
            'user_id' => fake()->unique()->numberBetween(1,12),
        ];
    }
}
