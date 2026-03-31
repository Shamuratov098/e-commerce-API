<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ProductService
{
    public function index(): Collection
    {
        return Product::with(['category', 'brand', 'photos'])->get();
    }

    public function show(Product $product): Product
    {
        return $product->load(['category', 'brand', 'photos', 'reviews']);
    }

    public function store(array $data): Product
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);

        return $product->fresh();
    }

    public function destroy(Product $product): bool
    {
        return $product->delete();
    }
}
