<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response()->json(['status' => 'OK']);
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['middleware' => ['api', 'auth'], 'prefix' => 'admin'], function ($router) {
   Route::resource('products', 'Admin\ProductsController')->except(['create', 'edit']);
   Route::post('products/{product}/attach', 'Admin\ProductsController@attach');
   Route::post('products/{product}/detach', 'Admin\ProductsController@detach');
});

Route::group(['middleware' => 'api'], function ($router) {
    Route::get('products', 'ProductsController@index');
    Route::get('products/{product}', 'ProductsController@show');
    Route::post('order', 'OrdersController@place_order');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
