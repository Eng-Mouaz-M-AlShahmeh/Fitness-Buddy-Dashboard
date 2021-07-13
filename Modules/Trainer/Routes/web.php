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

//Route::prefix('trainer')->group(function() {
//    Route::get('/', 'TrainerController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('trainer')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'TrainerController@index')->name('trainer.index');
            Route::get('/create','TrainerController@create')->name('trainer.create');
            Route::post('/store','TrainerController@store')->name('trainer.store');
            Route::get('/edit/{id}','TrainerController@edit')->name('trainer.edit');
            Route::get('/show/{id}','TrainerController@show')->name('trainer.show');
            Route::post('/update/{id}','TrainerController@update')->name('trainer.update');
            Route::post('/{id}','TrainerController@destroy')->name('trainer.destroy');
            Route::post('/status/{id}', 'TrainerController@updateStatus')->name('trainer.status');
        });
    });
});
//});
