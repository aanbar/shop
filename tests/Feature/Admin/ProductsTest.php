<?php

namespace Tests\Feature\Admin;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_list_products()
    {
        $Products = factory(Product::class, 3)->create();
        $response = $this->getJson('/admin/products');
        $this->assertCount(3, $response->json());
        $this->assertJsonStringEqualsJsonString($Products->toJson(), $response->content());
    }

    public function test_can_create_product()
    {
        $product = ['name' => 'Product', 'price' => 10, 'discount' => 1, 'discount_type' => 'Fixed'];
        $response = $this->postJson( '/admin/products', $product);
        $this->assertDatabaseHas('products', $product);
        $response->assertStatus(201);
        $response->assertJson($product);
    }

    public function test_cannot_add_product_with_missing_info()
    {
        $product = ['name' => 'Product', 'price' => null, 'discount' => 1, 'discount_type' => 'Fixed'];
        $response = $this->postJson( '/admin/products', $product);
        $response->assertStatus(422);
        $response->assertJsonStructure(['errors', 'message']);
    }

    public function test_can_view_product()
    {
        $product = factory(Product::class)->create();
        $response = $this->getJson( "/admin/products/{$product->id}");
        $response->assertOk();
        $response->assertJsonStructure(['id', 'name', 'price', 'discount_type', 'discount']);
    }

    public function test_can_update_product()
    {
        $product = factory(Product::class)->create();
        $response = $this->putJson("/admin/products/{$product->id}", ['price' => 10]);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'price' => 10]);
        $response->assertOk();
    }

    public function test_can_destroy_product()
    {
        $product = factory(Product::class)->create();
        $response = $this->deleteJson("/admin/products/{$product->id}");
        $this->assertDatabaseMissing('products', $product->toArray());
        $response->assertOk();
    }
}
