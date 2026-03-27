<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $users = User::all();

        foreach ($products as $product) {
            Reviews::factory()->count(fake()->numberBetween(1, 2))->create([
                'reviewable_id' => $product->id,
                'reviewable_type' => Product::class,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
