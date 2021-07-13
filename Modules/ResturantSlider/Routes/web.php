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

//Route::prefix('resturantslider')->group(function() {
//    Route::get('/', 'ResturantSliderController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('resturant')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
//            Route::get('/slider', 'ResturantSliderController@index')->name('resturant.sliders.index');
//            Route::get('slider/create','ResturantSliderController@create')->name('resturant.sliders.create');
//            Route::post('slider/store','ResturantSliderController@store')->name('resturant.sliders.store');
            Route::get('slider/edit/{id}','ResturantSliderController@edit')->name('resturant.sliders.edit');
            Route::post('slider/update/{id}','ResturantSliderController@update')->name('resturant.sliders.update');
            Route::post('slider/{id}','ResturantSliderController@destroy')->name('resturant.sliders.destroy');
            Route::post('slider/status/{id}', 'ResturantSliderController@updateStatus')->name('resturant.sliders.status');
        });
    });
});
//});
