<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:draft,paid,cancelled',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',

        ]);

        $order = DB::transaction(function () use ($data) {
            $order = Order::create([
                'customer_id' => $data['customer_id'],
                'status' => $data['status'],
                'total' => 0,
            ]);

            $total = 0;

            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);

                // cek stok hanya jika status paid

                if ($data['status'] == 'paid' && $product->stock < $item['quantity']) {
                    throw new \Exception("Stok tidak cukup untuk produk: {$product->name}");
                }

                $subtotal = $item['quantity'] * $product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                // kurangi stok jika paid
                if ($data['status'] == 'paid') {
                    $product->decrement('stock', $item['quantity']);
                }

                $total += $subtotal;
            }

            $order->update(['total' => $total]);

            return $order->load('items');
        });

        return response()->json($order, 201);
    }
}
