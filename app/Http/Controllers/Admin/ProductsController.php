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
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index()
    {
        $Products = Product::all();
        return new ProductCollection($Products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProductRequest $request)
    {
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('Bundle');
        return response()->json($product->toArray(), 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $Updated = $product->update($request->all());
        return response()->json($Updated ? ['success' => true, 'data' => $product] : ['success' => false]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
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

    public function attach(Product $product, AttachProductsToBundleRequest $request)
    {
        $Products = Product::whereIn('id', $request->products);
        $product->Bundle()->attach($Products->pluck('id'));
        return response()->json(['success' => true, 'message' => 'products added to bundle']);
    }

    public function detach(Product $product, AttachProductsToBundleRequest $request)
    {
        $Products = Product::whereIn('id', $request->products);
        $product->Bundle()->detach($Products->pluck('id'));
        return response()->json(['success' => true, 'message' => 'products added to bundle']);
    }
}
