<?php
use \App\Http\Middleware\SetLocale;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::prefix('meal')->group(function() {
//    Route::get('/', 'MealController@index');
//});
  Route::get('get-resturant-cats/{resturant_id}', 'MealController@getResturantCats');
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('meal')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'MealController@index')->name('meals.index');
//            Route::get('/create','MealController@create')->name('meals.create');
//            Route::post('/store','MealController@store')->name('meals.store');
            Route::get('/edit/{id}','MealController@edit')->name('meals.edit');
            Route::post('/update/{id}','MealController@update')->name('meals.update');
            Route::post('/{id}','MealController@destroy')->name('meals.destroy');
            Route::post('/status/{id}', 'MealController@updateStatus')->name('meals.status');


        });
    });
});
//});
