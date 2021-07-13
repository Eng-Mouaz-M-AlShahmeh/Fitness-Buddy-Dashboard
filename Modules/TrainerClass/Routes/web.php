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

//Route::prefix('trainerclass')->group(function() {
//    Route::get('/', 'TrainerClassController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('trainerclass')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'TrainerClassController@index')->name('trainer.class.index');
            Route::get('/create','TrainerClassController@create')->name('trainer.class.create');
            Route::post('/store','TrainerClassController@store')->name('trainer.class.store');
            Route::get('/edit/{id}','TrainerClassController@edit')->name('trainer.class.edit');
            Route::post('/update/{id}','TrainerClassController@update')->name('trainer.class.update');
            Route::post('/{id}','TrainerClassController@destroy')->name('trainer.class.destroy');
        });
    });
});
//});
