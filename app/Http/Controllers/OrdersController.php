<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderItems;
use App\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * @api {post} /order place your order
     * @apiPermission None
     * @apiName placeOrder
     * @apiParam {string} first_name First Name
     * @apiParam {string} last_name Last Name
     * @apiParam {string} email Email Address
     * @apiParam {string} phone Phone Number
     * @apiParam {string} address Address
     * @apiParam {string} city City
     * @apiParam {string} country Country
     * @apiParam {array} products Products you are ordering e.g: [{id: 1, quantity: 4}, {id: 2, quantity: 1}]
     * @apiGroup Products
     *
     */
    public function place_order(PlaceOrderRequest $request)
    {
        $Quantities = collect($request->products)->pluck('quantity', 'id');
        $Products = Product::with('Bundle')->whereIn('id', array_keys($Quantities->toArray()))->get();
        // create order
        $Order = Order::create($request->all());
        $OrderItems = [];
        foreach ($Products as $product) {
            $OrderItems[] = new OrderItems([
                'quantity' => $Quantities[$product->id],
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_discount_type' => $product->discount_type,
                'product_discount' => $product->discount,
                'bundle_data' => json_encode($product->Bundle)
            ]);
        }

        $Order->Items()->saveMany($OrderItems);
        $data = Order::with('Items')->find($Order->id);
        return response()->json(['success' => true, 'data' => new OrderResource($data)]);
    }
}
