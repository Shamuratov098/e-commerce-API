<?php

namespace Database\Factories;

use App\Models\Reviews;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reviews>
 */
class ReviewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'comment' => fake()->paragraph(2),
            'rating' => fake()->randomElement(['1', '2', '3', '4', '5']),
        ];
    }
}
