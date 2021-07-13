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

//Route::prefix('language')->group(function() {
//    Route::get('/', 'LanguageController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('language')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'LanguageController@index')->name('language.index');
            Route::get('/create','LanguageController@create')->name('language.create');
            Route::post('/store','LanguageController@store')->name('language.store');
            Route::get('/edit/{id}','LanguageController@edit')->name('language.edit');
            Route::post('/update/{id}','LanguageController@update')->name('language.update');
            Route::post('/{id}','LanguageController@destroy')->name('language.destroy');
            Route::post('/status/{id}', 'LanguageController@updateStatus')->name('language.status');
        });
    });
});
//});
