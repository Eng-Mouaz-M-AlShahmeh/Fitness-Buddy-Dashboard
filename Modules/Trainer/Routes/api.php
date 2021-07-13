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

//Route::middleware('auth:api')->get('/trainer', function (Request $request) {
//    return $request->user();
//});

Route::get('/trainers', 'Api\TrainersController@trainers');
Route::get('/trainerdetails', 'Api\TrainersController@trainerDetails');
Route::get('/searchtrainers', 'Api\TrainersController@searchTrainers');
