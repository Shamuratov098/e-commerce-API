<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function __construct(
        private CartService $cartService
    ) {}

    public function index(): JsonResponse
    {
        $carts = $this->cartService->index();

        return response()->json($carts);
    }

    public function store(StoreCartRequest $request): JsonResponse
    {
        $cart = $this->cartService->store($request->validated());

        return response()->json([
            'message' => 'Product added to cart',
            'cart' => $cart,
        ], 201);
    }

    public function update(UpdateCartRequest $request, Cart $cart): JsonResponse
    {
        $cart = $this->cartService->update($cart, $request->validated());

        return response()->json([
            'message' => 'Cart updated successfully',
            'cart' => $cart,
        ]);
    }

    public function destroy(Cart $cart): JsonResponse
    {
        $this->cartService->destroy($cart);

        return response()->json([
            'message' => 'Item removed from cart',
        ]);
    }
}
