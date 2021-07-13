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

//Route::middleware('auth:api')->get('/auth', function (Request $request) {
//    return $request->user();
//});
//Route::group([
//    'prefix' => 'auth'
//], function () {
//
//    Route::group([
//        'middleware' => 'auth:api'
//    ], function () {
//
//
//    });
//});
Route::post('auth/login', 'Api\AuthController@login');
Route::post('auth/signup', 'Api\AuthController@signup');
Route::post('auth/verification', 'Api\AuthController@VerifyCode');
Route::post('auth/logout', 'Api\AuthController@logout');
Route::post('auth/changepassword','Api\AuthController@ChangePassword');
Route::post('auth/forgetpassword', 'Api\AuthController@forgetPassword');
Route::post('auth/resetpassword', 'Api\AuthController@resetPassword');
