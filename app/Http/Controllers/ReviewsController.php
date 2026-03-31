<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewsRequest;
use App\Http\Requests\UpdateReviewsRequest;
use App\Models\Product;
use App\Models\Reviews;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;

class ReviewsController extends Controller
{
    public function __construct(
        private readonly ReviewService $reviewService
    ) {}

    public function indexForProduct(Product $product): JsonResponse
    {
        $reviews = $this->reviewService->indexForProduct($product->id);

        return response()->json($reviews);
    }

    public function store(StoreReviewsRequest $request, Product $product): JsonResponse
    {
        $this->authorize('create', Reviews::class);
        $review = $this->reviewService->store($request->validated(), $product->id);

        return response()->json([
            'message' => 'Review created successfully',
            'review' => $review,
        ], 201);
    }

    public function update(UpdateReviewsRequest $request, Reviews $review): JsonResponse
    {
        $this->authorize('update', $review);
        $review = $this->reviewService->update($review, $request->validated());

        return response()->json([
            'message' => 'Review updated successfully',
            'review' => $review,
        ]);
    }

    public function destroy(Reviews $review): JsonResponse
    {
        $this->authorize('delete', $review);
        $this->reviewService->destroy($review);

        return response()->json([
            'message' => 'Review deleted successfully',
        ]);
    }
}
