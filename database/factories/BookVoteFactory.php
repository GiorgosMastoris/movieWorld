<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookVoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'book_id' => '',
            'user_id' => '',
            'type' => $this->faker->randomElement(['like', 'hate']),
        ];
    }
}
