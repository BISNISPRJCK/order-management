<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;


use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;


class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_paid_reduces_product_stock()
    {

        $user = User::factory()->create([
            'role' => 'admin'
        ]);

        $product = Product::create([
            'name' => "Meja",
            'price' => 10000,
            'stock' => 10
        ]);

        $customer = Customer::create([
            'name' => 'budi',
            'phone' => '08123456789'
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/orders', [
                'customer_id' => $customer->id,
                'status' => 'paid',
                'items' => [
                    [
                        'product_id' => $product->id,
                        'quantity' => 3
                    ]
                ]

            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 7
        ]);
    }
}
