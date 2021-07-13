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

//Route::prefix('trainerslider')->group(function() {
//    Route::get('/', 'TrainerSliderController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('trainer')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/slider', 'TrainerSliderController@index')->name('trainer.sliders.index');
            Route::get('slider/create','TrainerSliderController@create')->name('trainer.sliders.create');
            Route::post('slider/store','TrainerSliderController@store')->name('trainer.sliders.store');
            Route::get('slider/edit/{id}','TrainerSliderController@edit')->name('trainer.sliders.edit');
            Route::post('slider/update/{id}','TrainerSliderController@update')->name('trainer.sliders.update');
            Route::post('slider/{id}','TrainerSliderController@destroy')->name('trainer.sliders.destroy');
            Route::post('slider/status/{id}', 'TrainerSliderController@updateStatus')->name('trainer.sliders.status');
        });
    });
});
//});
