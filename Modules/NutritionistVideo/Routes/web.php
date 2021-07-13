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

//Route::prefix('nutritionistvideo')->group(function() {
//    Route::get('/', 'NutritionistVideoController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('nutritionist')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/video', 'NutritionistVideoController@index')->name('nutritionist.videos.index');
            Route::get('video/create','NutritionistVideoController@create')->name('nutritionist.videos.create');
            Route::post('video/store','NutritionistVideoController@store')->name('nutritionist.videos.store');
            Route::get('video/edit/{id}','NutritionistVideoController@edit')->name('nutritionist.videos.edit');
            Route::post('video/update/{id}','NutritionistVideoController@update')->name('nutritionist.videos.update');
            Route::post('video/{id}','NutritionistVideoController@destroy')->name('nutritionist.videos.destroy');
            Route::post('video/status/{id}', 'NutritionistVideoController@updateStatus')->name('nutritionist.videos.status');
        });
    });
});
//});
