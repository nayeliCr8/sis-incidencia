<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Oficina>
 */
class OficinaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $v = 0;
    public function definition(): array
    {
        return [
            'nombre' => 'Oficina '.str_pad(++$this->v, 2, '0', STR_PAD_LEFT),
            'sede_id' => fake()->numberBetween(1,5),
        ];
    }
}
