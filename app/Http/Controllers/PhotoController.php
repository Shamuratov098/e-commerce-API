<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Models\Brand;
use App\Models\Photo;
use App\Models\Product;
use App\Services\PhotoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function __construct(
        private readonly PhotoService $photoService
    ) {}

    public function storeForProduct(StorePhotoRequest $request, Product $product): JsonResponse
    {
        $photo = $this->photoService->storeForProduct($request->validated(), $product->id);

        return response()->json([
            'message' => 'Photo added to product',
            'photo' => $photo,
        ], 201);
    }

    public function storeForBrand(StorePhotoRequest $request, Brand $brand): JsonResponse
    {
        $photo = $this->photoService->storeForBrand($request->validated(), $brand->id);

        return response()->json([
            'message' => 'Photo added to brand',
            'photo' => $photo,
        ], 201);
    }

    public function setMain(Request $request, Photo $photo): JsonResponse
    {
        $photo = $this->photoService->setMain($photo);

        return response()->json([
            'message' => 'Photo set as main',
            'photo' => $photo,
        ]);
    }

    public function destroy(Photo $photo): JsonResponse
    {
        $this->photoService->destroy($photo);

        return response()->json([
            'message' => 'Photo deleted successfully',
        ]);
    }
}
