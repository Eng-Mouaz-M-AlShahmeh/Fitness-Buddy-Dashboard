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

//Route::prefix('city')->group(function() {
//    Route::get('/', 'CityController@index');
//});

Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setLocale')->group(function (){
Route::prefix('city')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'CityController@index')->name('city.index');
            Route::get('/create','CityController@create')->name('city.create');
            Route::post('/store','CityController@store')->name('city.store');
            Route::get('/edit/{id}','CityController@edit')->name('city.edit');
            Route::post('/update/{id}','CityController@update')->name('city.update');
            Route::post('/{id}','CityController@destroy')->name('city.destroy');
            Route::post('/status/{id}', 'CityController@updateStatus')->name('city.status');
        });
    });
});
//});
