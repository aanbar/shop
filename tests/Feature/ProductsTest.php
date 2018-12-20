<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    protected $products;

    public function setUp()
    {
        parent::setUp();
        $this->products = factory(Product::class, 3)->create();
    }

    public function test_can_fetch_products_list()
    {
        $response = $this->getJson('/products');
        $response->assertOk();
        $response->assertJsonCount(3);
        $response->assertJson($this->products->toArray());
    }

    public function test_can_fetch_product_by_id()
    {
        $response = $this->getJson('/products/1');
        $response->assertOk();
        $response->assertJsonStructure(['id', 'name', 'price', 'discount_type', 'discount']);
    }
}
