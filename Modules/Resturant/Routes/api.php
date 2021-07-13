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

//Route::middleware('auth:api')->get('/resturant', function (Request $request) {
//    return $request->user();
//});
Route::get('/resturants', 'Api\ResturantController@resturants');
Route::get('/resturantcategories', 'Api\ResturantController@resturantCategories');
Route::get('/resturantdetails', 'Api\ResturantController@resturantDetails');
Route::post('/resturantratings', 'Api\ResturantController@rateResturant');
Route::get('/mealdetails', 'Api\ResturantController@mealDetails');
Route::get('/searchresturants', 'Api\ResturantController@searchResturant');
Route::get('/searchmeals', 'Api\ResturantController@searchMeals');
Route::get('/filter/resturants', 'Api\ResturantController@filterResturants');
Route::get('/resturants/dailyplan/mealsday', 'Api\ResturantController@getGetMealsDay');
