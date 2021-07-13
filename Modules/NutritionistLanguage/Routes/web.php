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

//Route::prefix('nutritionistlanguage')->group(function() {
//    Route::get('/', 'NutritionistLanguageController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('nutritionistlanguage')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'NutritionistLanguageController@index')->name('nutritionist.language.index');
            Route::get('/create','NutritionistLanguageController@create')->name('nutritionist.language.create');
            Route::post('/store','NutritionistLanguageController@store')->name('nutritionist.language.store');
            Route::get('/edit/{id}','NutritionistLanguageController@edit')->name('nutritionist.language.edit');
            Route::post('/update/{id}','NutritionistLanguageController@update')->name('nutritionist.language.update');
            Route::post('/{id}','NutritionistLanguageController@destroy')->name('nutritionist.language.destroy');
        });
    });
});
//});
