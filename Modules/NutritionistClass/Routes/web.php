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

//Route::prefix('nutritionistclass')->group(function() {
//    Route::get('/', 'NutritionistClassController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('nutritionistclass')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'NutritionistClassController@index')->name('nutritionist.class.index');
            Route::get('/create','NutritionistClassController@create')->name('nutritionist.class.create');
            Route::post('/store','NutritionistClassController@store')->name('nutritionist.class.store');
            Route::get('/edit/{id}','NutritionistClassController@edit')->name('nutritionist.class.edit');
            Route::post('/update/{id}','NutritionistClassController@update')->name('nutritionist.class.update');
            Route::post('/{id}','NutritionistClassController@destroy')->name('nutritionist.class.destroy');
        });
    });
});
//});
