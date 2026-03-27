<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $brands = Brand::all();

        foreach ($products as $product) {
            Photo::factory()->count(2)->create([
                'photoable_id' => $product->id,
                'photoable_type' => Product::class,
            ]);
        }

        foreach ($brands as $brand) {
            Photo::factory()->count(1)->create([
                'photoable_id' => $brand->id,
                'photoable_type' => Brand::class,
            ]);
        }
    }
}
