<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
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
            'status' => fake()->randomElement(['pending', 'processing', 'delivered', 'cancelled']),
            'total_amount' => fake()->numberBetween(10000, 999999),
            'delivery_address' => fake()->address(),
            'payment_method' => fake()->randomElement(['cash', 'paypal']),
        ];
    }
}
