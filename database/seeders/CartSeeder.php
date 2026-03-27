<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {
            Cart::factory()->count(fake()->numberBetween(1, 2))->create([
                'user_id' => $user->id,
                'product_id' => $products->random()->id,
            ]);
        }
    }
}
