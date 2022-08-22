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



/**
* Products
*/
Route::resource('workers','Api\Worker\WorkerController', [ 'except'=>['create','edit'], 'names' => ['index' => 'api.workers'] ] )->middleware('auth-ccloud');
Route::get('/search-workers/more-results','Api\Worker\WorkerController@moreResults')->name('api.workers.more.results');
