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

//Route::prefix('nutritionist')->group(function() {
//    Route::get('/', 'NutritionistController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('nutritionist')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'NutritionistController@index')->name('nutritionist.index');
            Route::get('/create','NutritionistController@create')->name('nutritionist.create');
            Route::post('/store','NutritionistController@store')->name('nutritionist.store');
            Route::get('/edit/{id}','NutritionistController@edit')->name('nutritionist.edit');
            Route::get('/show/{id}','NutritionistController@show')->name('nutritionist.show');
            Route::post('/update/{id}','NutritionistController@update')->name('nutritionist.update');
            Route::post('/{id}','NutritionistController@destroy')->name('nutritionist.destroy');
            Route::post('/status/{id}', 'NutritionistController@updateStatus')->name('nutritionist.status');
        });
    });
});
//});
