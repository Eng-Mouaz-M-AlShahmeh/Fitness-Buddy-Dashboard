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

//Route::prefix('modifier')->group(function() {
//    Route::get('/', 'ModifierController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('modifier')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'ModifierController@index')->name('modifier.index');
            Route::get('/create','ModifierController@create')->name('modifier.create');
            Route::post('/store','ModifierController@store')->name('modifier.store');
            Route::get('/edit/{id}','ModifierController@edit')->name('modifier.edit');
            Route::post('/update/{id}','ModifierController@update')->name('modifier.update');
            Route::post('/{id}','ModifierController@destroy')->name('modifier.destroy');
            Route::post('/status/{id}', 'ModifierController@updateStatus')->name('modifier.status');
        });
    });
});
//});
