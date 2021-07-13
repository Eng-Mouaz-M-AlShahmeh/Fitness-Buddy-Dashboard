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

//Route::prefix('fitnessclub')->group(function() {
//    Route::get('/', 'FitnessClubController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('fitnessclub')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'FitnessClubController@index')->name('fitness.club.index');
            Route::get('/create','FitnessClubController@create')->name('fitness.club.create');
            Route::post('/store','FitnessClubController@store')->name('fitness.club.store');
            Route::get('/edit/{id}','FitnessClubController@edit')->name('fitness.club.edit');
            Route::get('/show/{id}','FitnessClubController@show')->name('fitness.club.show');
            Route::post('/update/{id}','FitnessClubController@update')->name('fitness.club.update');
            Route::post('/{id}','FitnessClubController@destroy')->name('fitness.club.destroy');
            Route::post('/status/{id}', 'FitnessClubController@updateStatus')->name('fitness.club.status');
        });
    });
});
//});
