<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * E-commerce categories list.
     *
     * @var array<string>
     */
    private array $categories = [
        'Elektronika',
        'Kiyim',
        'Oziq-ovqat',
        'Uy-ro\'zg\'or',
        'Sport',
        'Zargarlik',
        'Kitob',
        'Gullar',
        'O\'yinchoqlar',
        'Avtotovar',
    ];

    private static int $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->categories[self::$index % count($this->categories)];
        self::$index++;

        return [
            'title' => $title,
            'slug' => Str::slug($title.'-'.fake()->unique()->numberBetween(1, 1000)),
        ];
    }
}
