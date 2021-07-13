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

//Route::prefix('mealmodifier')->group(function() {
//    Route::get('/', 'MealModifierController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('mealmodifier')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'MealModifierController@index')->name('meal.modifier.index');
            //Route::get('/create','MealModifierController@create')->name('meal.modifier.create');
            //Route::post('/store','MealModifierController@store')->name('meal.modifier.store');
            Route::get('/edit/{id}','MealModifierController@edit')->name('meal.modifier.edit');
            Route::post('/update/{id}','MealModifierController@update')->name('meal.modifier.update');
            Route::post('/{id}','MealModifierController@destroy')->name('meal.modifier.destroy');
        });
    });
});
//});
