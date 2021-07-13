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

//Route::prefix('day')->group(function() {
//    Route::get('/', 'DayController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setLocale')->group(function (){
Route::prefix('day')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'DayController@index')->name('day.index');
            Route::get('/create','DayController@create')->name('day.create');
            Route::post('/store','DayController@store')->name('day.store');
            Route::get('/edit/{id}','DayController@edit')->name('day.edit');
            Route::post('/update/{id}','DayController@update')->name('day.update');
            Route::post('/{id}','DayController@destroy')->name('day.destroy');
            Route::post('/status/{id}', 'DayController@updateStatus')->name('day.status');
        });
    });
});
