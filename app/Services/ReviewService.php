<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function indexForProduct(int $productId): Collection
    {
        return Reviews::where('reviewable_type', Product::class)
            ->where('reviewable_id', $productId)
            ->with('user')
            ->get();
    }

    public function store(array $data, int $productId): Reviews
    {
        $data['user_id'] = Auth::id();
        $data['reviewable_type'] = Product::class;
        $data['reviewable_id'] = $productId;

        return Reviews::create($data);
    }

    public function update(Reviews $review, array $data): Reviews
    {
        $review->update($data);

        return $review->fresh();
    }

    public function destroy(Reviews $review): bool
    {
        return $review->delete();
    }
}
