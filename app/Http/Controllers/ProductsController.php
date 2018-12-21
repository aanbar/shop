<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Product;

class ProductsController extends Controller
{
    /**
     * @api {get} /products list products
     * @apiName listProducts
     * @apiPermission None
     * @apiGroup Products
     */
    public function index()
    {
        $Products = Product::with('Bundle')->get();
        return new ProductCollection($Products);
    }

    /**
     * @api {get} /products/:id display a single product
     * @apiPermission None
     * @apiName showProduct
     * @apiParam {number} id product id
     * @apiGroup Products
     *
     */
    public function show(Product $product)
    {
        $product->load('Bundle');
        return $product;
    }
}
