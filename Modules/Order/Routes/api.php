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

//Route::middleware('auth:api')->get('/order', function (Request $request) {
//    return $request->user();
//});

Route::post('resturants/checkout','Api\OrdersController@resturantOrder');
Route::post('fitnessclub/checkout','Api\OrdersController@subscriptionOrder');
Route::post('nutritionist/checkout','Api\OrdersController@nutritionistOrder');
Route::post('trainer/checkout','Api\OrdersController@trainerOrder');

Route::post('payment/callback','Api\OrdersController@paymentCallBack');


Route::get('order/payment/onlinePayment','Api\OrdersController@onlinePayment');
Route::get('order/payment/checkPayment','Api\OrdersController@checkPayment');