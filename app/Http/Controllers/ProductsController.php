<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Product;

class ProductsController extends Controller
{
    /**
     * @return ProductCollection
     */
    public function index()
    {
        $Products = Product::with('Bundle')->get();
        return new ProductCollection($Products);
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function show(Product $product)
    {
        $product->load('Bundle');
        return $product;
    }
}
