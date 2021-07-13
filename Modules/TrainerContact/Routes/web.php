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
Route::prefix('trainercontact')->group(function() {
    Route::get('/', 'TrainerContactController@index')->name('trainercontact.index');
    Route::post('/{id}','TrainerContactController@destroy')->name('trainercontact.destroy');
    
    Route::get('/show/{id}','TrainerContactController@show')->name('trainercontact.show');
    Route::get('/pdf/{id}','TrainerContactController@pdf')->name('trainercontact.pdf');
    
});
//});
