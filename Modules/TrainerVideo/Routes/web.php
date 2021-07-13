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

//Route::prefix('trainervideo')->group(function() {
//    Route::get('/', 'TrainerVideoController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('trainer')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/video', 'TrainerVideoController@index')->name('trainer.images.index');
            Route::get('video/create','TrainerVideoController@create')->name('trainer.images.create');
            Route::post('video/store','TrainerVideoController@store')->name('trainer.images.store');
            Route::get('video/edit/{id}','TrainerVideoController@edit')->name('trainer.images.edit');
            Route::post('video/update/{id}','TrainerVideoController@update')->name('trainer.images.update');
            Route::post('video/{id}','TrainerVideoController@destroy')->name('trainer.images.destroy');
            Route::post('video/status/{id}', 'TrainerVideoController@updateStatus')->name('trainer.images.status');
        });
    });
});
//});
