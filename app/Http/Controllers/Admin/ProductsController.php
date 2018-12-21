<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttachProductsToBundleRequest;
use App\Http\Requests\SaveProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @api {get} /admin/products list products
     * @apiPermission authenticated
     * @apiName ListProducts
     * @apiGroup Admin
     */
    public function index()
    {
        $Products = Product::all();
        return new ProductCollection($Products);
    }

    /**
     * @api {post} /admin/products add a new product
     * @apiPermission authenticated
     * @apiName addProduct
     * @apiParam {string} name Mandatory Product Name
     * @apiParam {decimal} price Mandatory Product Price
     * @apiParam {string} discount_type One of the following ['None', 'Percentage', 'Fixed']
     * @apiParam {decimal} discount
     * @apiGroup Admin
     */
    public function store(SaveProductRequest $request)
    {
        return Product::create($request->all());
    }

    /**
     * @api {get} /admin/products/:id display a single product
     * @apiPermission authenticated
     * @apiName showProduct
     * @apiParam {number} id product id
     * @apiGroup Admin
     *
     */
    public function show(Product $product)
    {
        $product->load('Bundle');
        return response()->json($product->toArray(), 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * @api {patch} /admin/products/:id update existing product
     * @apiPermission authenticated
     * @apiName updateProduct
     * @apiParam {number} id product id
     * @apiParam {string} name Product Name
     * @apiParam {decimal} price Product Price
     * @apiParam {string} discount_type One of the following ['None', 'Percentage', 'Fixed']
     * @apiParam {decimal} discount
     * @apiGroup Admin
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $Updated = $product->update($request->all());
        return response()->json($Updated ? ['success' => true, 'data' => $product] : ['success' => false]);
    }

    /**
     * @api {delete} /admin/products/:id delete a product
     * @apiPermission authenticated
     * @apiName deleteProduct
     * @apiParam {number} id product id
     * @apiGroup Admin
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(['success' => true, 'message' => "{$product->id} was successfully deleted"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @api {post} /admin/products/:id/attach bundle products with existing product
     * @apiPermission authenticated
     * @apiName attachProducts
     * @apiParam {number} id the id of the product you are updating
     * @apiParam {array} products array containing products ids you want to associate with this product
     * @apiGroup Admin
     */
    public function attach(Product $product, AttachProductsToBundleRequest $request)
    {
        $Products = Product::whereIn('id', $request->products);
        $product->Bundle()->attach($Products->pluck('id'));
        return response()->json(['success' => true, 'message' => 'products added to bundle']);
    }


    /**
     * @api {post} /admin/products/:id/detach remove products from bundled product
     * @apiPermission authenticated
     * @apiName detachProduct
     * @apiParam {number} id the id of the product you are updating
     * @apiParam {array} products array containing products ids you want to associate with this product
     * @apiGroup Admin
     */
    public function detach(Product $product, AttachProductsToBundleRequest $request)
    {
        $Products = Product::whereIn('id', $request->products);
        $product->Bundle()->detach($Products->pluck('id'));
        return response()->json(['success' => true, 'message' => 'products added to bundle']);
    }
}
