<?php

namespace Tests\Feature\Admin;

use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsBundleTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function test_can_add_products_group()
    {
        $Bundle = factory(Product::class)->create();
        $ProductsToAdd = factory(Product::class, 3)->create();
        $ids = $ProductsToAdd->pluck('id')->all();
        $response = $this->addLoginHeader($this->user)->postJson("/admin/products/{$Bundle->id}/attach", ['products' => $ids]);
        $response->assertOk();
        foreach ($ids as $id) {
            $this->assertDatabaseHas('products_bundle', ['parent_product_id' => $Bundle->id, 'product_id' => $id]);
        }
    }

    public function test_cannot_pass_empty_product_list()
    {
        $Bundle = factory(Product::class)->create();
        $response = $this->addLoginHeader($this->user)->postJson("/admin/products/{$Bundle->id}/attach", ['products' => []]);
        $response->assertStatus(422);
    }

    public function test_can_remove_products_from_bundle()
    {
        $Bundle = factory(Product::class)->create();
        $ProductsToAdd = factory(Product::class, 3)->create();
        $ids = $ProductsToAdd->pluck('id')->all();
        $Bundle->Bundle()->attach($ids);
        $toRemove = array_slice($ids, 0, 2);
        $response = $this->addLoginHeader($this->user)->postJson("/admin/products/{$Bundle->id}/detach", ['products' => $toRemove]);
        $response->assertOk();
        foreach ($toRemove as $id) {
            $this->assertDatabaseMissing('products_bundle', ['parent_product_id' => $Bundle->id, 'product_id' => $id]);
        }
    }
}
