<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function index(): Collection
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return Order::with('orderItems.product')->get();
        }

        return Order::where('user_id', $user->id)
            ->with('orderItems.product')
            ->get();
    }

    public function show(Order $order): Order
    {
        return $order->load('orderItems.product');
    }

    public function store(array $data): Order
    {
        $user = Auth::user();

        $cartItems = Cart::where('user_id', $user->id)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            abort(422, 'Cart is empty');
        }

        foreach ($cartItems as $cartItem) {
            if ($cartItem->product->stock_quantity < $cartItem->total_count) {
                abort(422, 'Insufficient stock for: '.$cartItem->product->name);
            }
        }

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 0,
            'delivery_address' => $data['delivery_address'],
            'payment_method' => $data['payment_method'],
        ]);

        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            $price = $cartItem->product->price;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->total_count,
                'price' => $price,
            ]);

            $totalAmount += $price * $cartItem->total_count;
        }

        $order->update(['total_amount' => $totalAmount]);

        Cart::where('user_id', $user->id)->delete();

        return $order->fresh();
    }

    public function updateStatus(Order $order, string $status): Order
    {
        $order->update(['status' => $status]);

        return $order->fresh();
    }

    public function destroy(Order $order): bool
    {
        return $order->delete();
    }
}
