<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandService
{
    public function index(): Collection
    {
        return Brand::with('photos')->get();
    }

    public function show(Brand $brand): Brand
    {
        return $brand->load(['photos', 'products']);
    }

    public function store(array $data): Brand
    {
        return Brand::create($data);
    }

    public function update(Brand $brand, array $data): Brand
    {
        $brand->update($data);

        return $brand->fresh();
    }

    public function destroy(Brand $brand): bool
    {
        return $brand->delete();
    }
}
