<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class PhotoService
{
    public function storeForProduct(array $data, int $productId): Photo
    {
        $path = $data['image']->store('products', 'public');

        return Photo::create([
            'image_url' => Storage::url($path),
            'photoable_type' => Product::class,
            'photoable_id' => $productId,
            'is_main' => $data['is_main'] ?? false,
        ]);
    }

    public function storeForBrand(array $data, int $brandId): Photo
    {
        $path = $data['image']->store('brands', 'public');

        return Photo::create([
            'image_url' => Storage::url($path),
            'photoable_type' => Brand::class,
            'photoable_id' => $brandId,
            'is_main' => $data['is_main'] ?? false,
        ]);
    }

    public function setMain(Photo $photo): Photo
    {
        Photo::where('photoable_type', $photo->photoable_type)
            ->where('photoable_id', $photo->photoable_id)
            ->update(['is_main' => false]);

        $photo->update(['is_main' => true]);

        return $photo->fresh();
    }

    public function destroy(Photo $photo): bool
    {
        return $photo->delete();
    }
}
