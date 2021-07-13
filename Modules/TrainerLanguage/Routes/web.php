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

//Route::prefix('trainerlanguage')->group(function() {
//    Route::get('/', 'TrainerLanguageController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('trainerlanguage')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'TrainerLanguageController@index')->name('trainer.language.index');
            Route::get('/create','TrainerLanguageController@create')->name('trainer.language.create');
            Route::post('/store','TrainerLanguageController@store')->name('trainer.language.store');
            Route::get('/edit/{id}','TrainerLanguageController@edit')->name('trainer.language.edit');
            Route::post('/update/{id}','TrainerLanguageController@update')->name('trainer.language.update');
            Route::post('/{id}','TrainerLanguageController@destroy')->name('trainer.language.destroy');
        });
    });
});
//});
