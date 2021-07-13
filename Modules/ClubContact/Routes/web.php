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
Route::prefix('clubcontact')->group(function() {
    Route::get('/', 'ClubContactController@index')->name('clubcontact.index');
    Route::post('/{id}','ClubContactController@destroy')->name('clubcontact.destroy');
    Route::get('/show/{id}','ClubContactController@show')->name('clubcontact.show');
    Route::get('/pdf/{id}','ClubContactController@pdf')->name('clubcontact.pdf');
     
});
//});
