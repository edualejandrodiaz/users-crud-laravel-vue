<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/debug', 'Back\Common\Product\ProductDataController@fileImageSpecial');

/**
* Products
*/
Route::resource('workers','Api\Worker\WorkerController', [ 'except'=>['create','edit'], 'names' => ['index' => 'api.workers'] ] )->middleware('auth-ccloud');
Route::get('/search-workers/more-results','Api\Worker\WorkerController@moreResults')->name('api.workers.more.results');
// Route::resource('products','Api\Product\ProductController', [ 'except'=>['create','edit'], 'names' => ['index' => 'api.products'] ] );
// Route::post('/product-pedido-especial/{customer}','Api\Product\ProductController@storeSpecial')->name('product.pedido.especial');
// Route::get('/active-ingredient/all','Api\Product\ProductController@allActiveIngredient')->name('api.active.ingrediente.all');
// Route::get('/search-products/more-results','Api\Product\ProductController@moreResults')->name('api.products.more.results');
// Route::resource('categories','Api\Product\CategoryController', [ 'except'=>['create','edit'], 'names' => ['index' => 'api.categories'] ] );

// Route::resource('shippings', 'Api\Shipping\ShippingController', [ 'except'=>['create','edit'], 'names' => ['index' => 'api.shippings'] ]);
// Route::resource('customers.carts.orders', 'Api\Order\OrderController', [ 'except'=>['create','edit'], 'names' => ['index' => 'api.customers.carts.orders'] ]);