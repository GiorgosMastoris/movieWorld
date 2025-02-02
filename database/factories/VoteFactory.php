<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => '',
            'user_id' => '',
            'type' => $this->faker->randomElement(['like', 'hate']),
        ];
    }
}
