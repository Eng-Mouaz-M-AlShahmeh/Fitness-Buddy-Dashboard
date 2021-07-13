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

//Route::prefix('nutritionistslider')->group(function() {
//    Route::get('/', 'NutritionistSliderController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('nutritionist')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/slider', 'NutritionistSliderController@index')->name('nutritionist.sliders.index');
            Route::get('slider/create','NutritionistSliderController@create')->name('nutritionist.sliders.create');
            Route::post('slider/store','NutritionistSliderController@store')->name('nutritionist.sliders.store');
            Route::get('slider/edit/{id}','NutritionistSliderController@edit')->name('nutritionist.sliders.edit');
            Route::post('slider/update/{id}','NutritionistSliderController@update')->name('nutritionist.sliders.update');
            Route::post('slider/{id}','NutritionistSliderController@destroy')->name('nutritionist.sliders.destroy');
            Route::post('slider/status/{id}', 'NutritionistSliderController@updateStatus')->name('nutritionist.sliders.status');
        });
    });
});
//});
