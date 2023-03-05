<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->streetName(),
            'date' => fake()->dateTimeBetween('-365 days', '+700 days'),
            'time' => fake()->time(),
            'place' => fake()->streetAddress(),
            'description' => fake()->realText(),
            'picture_path' => 'https://source.unsplash.com/random/100x100/?5'
        ];
    }
}
