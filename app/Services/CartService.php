<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function index(): Collection
    {
        return Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();
    }

    public function store(array $data): Cart
    {
        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $data['product_id'])
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'total_count' => $existingCart->total_count + $data['total_count'],
            ]);

            return $existingCart->fresh();
        }

        $data['user_id'] = Auth::id();

        return Cart::create($data);
    }

    public function update(Cart $cart, array $data): Cart
    {
        $cart->update($data);

        return $cart->fresh();
    }

    public function destroy(Cart $cart): bool
    {
        return $cart->delete();
    }
}
