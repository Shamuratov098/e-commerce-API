<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Popular brand names.
     *
     * @var array<string>
     */
    private array $brands = [
        'Samsung',
        'Apple',
        'Nike',
        'Adidas',
        'Nestle',
        'L\'Oreal',
        'Sony',
        'Canon',
        'LG',
        'Bosch',
    ];

    private static int $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->brands[self::$index % count($this->brands)];
        self::$index++;

        return [
            'name' => $name,
            'description' => fake()->paragraph(2),
        ];
    }
}
