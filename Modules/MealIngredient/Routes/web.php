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

//Route::prefix('mealingredient')->group(function() {
//    Route::get('/', 'MealIngredientController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('mealingredient')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'MealIngredientController@index')->name('meal.ingredient.index');
            //Route::get('/create','MealIngredientController@create')->name('meal.ingredient.create');
            //Route::post('/store','MealIngredientController@store')->name('meal.ingredient.store');
            Route::get('/edit/{id}','MealIngredientController@edit')->name('meal.ingredient.edit');
            Route::post('/update/{id}','MealIngredientController@update')->name('meal.ingredient.update');
            Route::post('/{id}','MealIngredientController@destroy')->name('meal.ingredient.destroy');
        });
    });
});
//});
