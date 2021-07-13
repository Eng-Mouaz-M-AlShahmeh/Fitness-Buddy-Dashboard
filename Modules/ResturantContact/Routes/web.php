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
Route::prefix('resturantcontact')->group(function() {
    Route::get('/', 'ResturantContactController@index')->name('resturantcontact.index');
    Route::post('/{id}','ResturantContactController@destroy')->name('resturantcontact.destroy');
    Route::get('/show/{id}','ResturantContactController@show')->name('resturantcontact.show');
    Route::get('/pdf/{id}','ResturantContactController@pdf')->name('resturantcontact.pdf');
    
});
//});
