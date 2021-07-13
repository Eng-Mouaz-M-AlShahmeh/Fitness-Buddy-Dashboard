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
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('user')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('', 'UserController@index')->name('user.index');
            Route::get('/show/{id}','UserController@show')->name('user.show');
            
            Route::get('/create','UserController@create')->name('user.create');
            Route::post('/store','UserController@store')->name('user.store');
            
            Route::get('/edit/{id}','UserController@edit')->name('user.edit');
            Route::post('/update/{id}','UserController@update')->name('user.update');
            
            Route::post('/{id}','UserController@destroy')->name('user.destroy');
            Route::post('/status/{id}', 'UserController@updateStatus')->name('user.status');
            
            
        });
    });
});
//});
