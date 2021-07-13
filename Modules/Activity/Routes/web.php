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

//Route::prefix('activity')->group(function() {
//    Route::get('/', 'ActivityController@index');
//});

Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});



//Route::middleware('setlocale')->group(function (){
Route::prefix('activity')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'ActivityController@index')->name('activity.index');
            Route::get('/create','ActivityController@create')->name('activity.create');
            Route::post('/store','ActivityController@store')->name('activity.store');
            Route::get('/edit/{id}','ActivityController@edit')->name('activity.edit');
            Route::post('/update/{id}','ActivityController@update')->name('activity.update');
            Route::post('/{id}','ActivityController@destroy')->name('activity.destroy');
        });
    });
});
//});
