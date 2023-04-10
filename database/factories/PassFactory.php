<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pass>
 */
class PassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => 'Silver',
            'price' => fake()->randomFloat(0, 2000, 50000),
            'available_quantity' => fake()->randomFloat(0, 20, 5000),

        ];
    }
}