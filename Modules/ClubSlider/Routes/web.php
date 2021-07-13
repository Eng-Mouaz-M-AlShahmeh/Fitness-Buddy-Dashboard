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

//Route::prefix('clubslider')->group(function() {
//    Route::get('/', 'ClubSliderController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('club')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/slider', 'ClubSliderController@index')->name('club.sliders.index');
            Route::get('slider/create','ClubSliderController@create')->name('club.sliders.create');
            Route::post('slider/store','ClubSliderController@store')->name('club.sliders.store');
            Route::get('slider/edit/{id}','ClubSliderController@edit')->name('club.sliders.edit');
            Route::post('slider/update/{id}','ClubSliderController@update')->name('club.sliders.update');
            Route::post('slider/{id}','ClubSliderController@destroy')->name('club.sliders.destroy');
            Route::post('slider/status/{id}', 'ClubSliderController@updateStatus')->name('club.sliders.status');
        });
    });
});
//});
