<?php

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

//Route::prefix('nutritionistcontact')->group(function() {
//    Route::get('/', 'NutritionistContactController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('nutritionistcontact')->group(function() {
    Route::get('/', 'NutritionistContactController@index')->name('nutritionistcontact.index');
    Route::post('/{id}','NutritionistContactController@destroy')->name('nutritionistcontact.destroy');
    
    Route::get('/show/{id}','NutritionistContactController@show')->name('nutritionistcontact.show');
    Route::get('/pdf/{id}','NutritionistContactController@pdf')->name('nutritionistcontact.pdf');
});
//});
