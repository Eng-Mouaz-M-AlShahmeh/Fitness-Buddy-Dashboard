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
Route::prefix('nationality')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'NationalityController@index')->name('nationality.index');
            Route::get('/create','NationalityController@create')->name('nationality.create');
            Route::post('/store','NationalityController@store')->name('nationality.store');
            Route::get('/edit/{id}','NationalityController@edit')->name('nationality.edit');
            Route::post('/update/{id}','NationalityController@update')->name('nationality.update');
            Route::post('/{id}','NationalityController@destroy')->name('nationality.destroy');
            Route::post('/status/{id}', 'NationalityController@updateStatus')->name('nationality.status');
        });
    });
});
//});
