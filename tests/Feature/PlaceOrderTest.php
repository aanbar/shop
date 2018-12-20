<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlaceOrderTest extends TestCase
{
    use RefreshDatabase;
    public function test_cannot_place_order_with_missing_info()
    {
        $response = $this->postJson('/order', []);
        $response->assertStatus(422);
    }

    public function test_cannot_place_order_without_products()
    {
        $Order = factory(Order::class)->make()->toArray();
        $response = $this->postJson('/order', $Order);
        $response->assertStatus(422);
        $Order['products'][] = [1 => 1];
        $response = $this->postJson('/order', $Order);
        $response->assertStatus(422);
    }

    public function test_can_place_order_with_valid_data()
    {
        $Order = factory(Order::class)->make()->toArray();
        $Product = factory(Product::class)->create();
        $Order['products'][] = ['id' => $Product->id, 'quantity' => 1];
        $response = $this->postJson('/order', $Order);
        $response->assertOk();
    }
}
