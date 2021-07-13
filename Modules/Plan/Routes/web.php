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
//
//Route::prefix('plan')->group(function() {
//    Route::get('/', 'PlanController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('plan')->group(function (){
    Route::get('','PlanController@index')->name('plan.index');
    Route::get('/create','PlanController@create')->name('plan.create');
    Route::post('/store','PlanController@store')->name('plan.store');
    Route::get('/edit/{id}','PlanController@edit')->name('plan.edit');
    Route::post('/update/{id}','PlanController@update')->name('plan.update');
    Route::post('/{id}','PlanController@destroy')->name('plan.destroy');
    Route::post('/status/{id}', 'PlanController@updateStatus')->name('plan.status');
});
//});
