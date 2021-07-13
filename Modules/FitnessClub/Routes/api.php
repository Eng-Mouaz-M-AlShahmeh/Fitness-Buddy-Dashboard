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

//Route::middleware('auth:api')->get('/fitnessclub', function (Request $request) {
//    return $request->user();
//});
Route::get('/fitnessclub', 'Api\FitnessClubController@clubs');
Route::post('/clubsratings', 'Api\FitnessClubController@rateClubs');
Route::get('/clubdetails', 'Api\FitnessClubController@clubDetails');
Route::get('/searchclubs', 'Api\FitnessClubController@searchClub');
