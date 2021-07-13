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

//Route::prefix('classes')->group(function() {
//    Route::get('/', 'ClassesController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('classes')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'ClassesController@index')->name('class.index');
            Route::get('/create','ClassesController@create')->name('class.create');
            Route::post('/store','ClassesController@store')->name('class.store');
            Route::get('/edit/{id}','ClassesController@edit')->name('class.edit');
            Route::post('/update/{id}','ClassesController@update')->name('class.update');
            Route::post('/{id}','ClassesController@destroy')->name('class.destroy');
            Route::post('/status/{id}', 'ClassesController@updateStatus')->name('class.status');
        });
    });
});
//});
