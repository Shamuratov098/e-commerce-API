<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $width = fake()->randomElement([400, 600, 800, 1200]);
        $height = fake()->randomElement([400, 600, 800, 1200]);

        return [
            'image_url' => 'https://picsum.photos/'.$width.'/'.$height,
            'is_main' => fake()->boolean(30),
        ];
    }
}
