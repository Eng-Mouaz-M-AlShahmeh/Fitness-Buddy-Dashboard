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

//Route::middleware('auth:api')->get('/cart', function (Request $request) {
//    return $request->user();
//});
Route::post('/addtocart','Api\CartController@addCart');
Route::get('/getcart','Api\CartController@getCartList');
Route::get('/getterms','Api\CartController@terms');
