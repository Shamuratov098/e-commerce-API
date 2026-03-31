<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    public function __construct(
        private BrandService $brandService
    ) {}

    public function index(): JsonResponse
    {
        $brands = $this->brandService->index();

        return response()->json($brands);
    }

    public function store(StoreBrandRequest $request): JsonResponse
    {
        $brand = $this->brandService->store($request->validated());

        return response()->json([
            'message' => 'Brand created successfully',
            'brand' => $brand,
        ], 201);
    }

    public function show(Brand $brand): JsonResponse
    {
        $brand = $this->brandService->show($brand);

        return response()->json($brand);
    }

    public function update(UpdateBrandRequest $request, Brand $brand): JsonResponse
    {
        $brand = $this->brandService->update($brand, $request->validated());

        return response()->json([
            'message' => 'Brand updated successfully',
            'brand' => $brand,
        ]);
    }

    public function destroy(Brand $brand): JsonResponse
    {
        $this->brandService->destroy($brand);

        return response()->json([
            'message' => 'Brand deleted successfully',
        ]);
    }
}
