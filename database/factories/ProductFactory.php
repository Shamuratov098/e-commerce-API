<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * E-commerce product names.
     *
     * @var array<string>
     */
    private array $products = [
        'Smartphone Samsung Galaxy',
        'MacBook Pro 14',
        'Nike Air Max',
        'Adidas Futbolka',
        'Elektrik Choynak',
        'Samsung Sovutgich',
        'Apple Watch Ultra',
        'Sony Quloqchin',
        'Canon Fotokamera',
        'LG Televizor',
    ];

    private static int $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->products[self::$index % count($this->products)];
        self::$index++;

        return [
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'name' => $name,
            'description' => fake()->paragraph(3),
            'stock_quantity' => fake()->numberBetween(5, 100),
            'status' => fake()->randomElement(['active', 'soon', 'out_of_stock']),
            'slug' => Str::slug($name.'-'.fake()->unique()->numberBetween(1, 1000)),
            'weight' => fake()->randomFloat(2, 0.1, 50),
            'price' => fake()->numberBetween(10000, 1000000),
        ];
    }
}
