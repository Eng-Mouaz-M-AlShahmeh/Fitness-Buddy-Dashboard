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
Route::prefix('admin')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
    Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
        Route::get('', 'AdminController@index')->name('admin.index');
        Route::get('/create','AdminController@create')->name('admin.create');
        Route::post('/store','AdminController@store')->name('admin.store');
        Route::get('/edit/{id}','AdminController@edit')->name('admin.edit');
        Route::post('/update/{id}','AdminController@update')->name('admin.update');
        Route::post('/{id}','AdminController@destroy')->name('admin.destroy');
    });
});
});
//});
