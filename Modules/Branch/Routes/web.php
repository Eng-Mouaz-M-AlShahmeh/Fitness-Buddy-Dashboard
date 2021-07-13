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

//Route::prefix('branch')->group(function() {
//    Route::get('/', 'BranchController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('branch')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
//            Route::get('/', 'BranchController@index')->name('branch.index');
//            Route::get('/create','BranchController@create')->name('branch.create');
//            Route::post('/store','BranchController@store')->name('branch.store');
            Route::get('/edit/{id}','BranchController@edit')->name('branch.edit');
            Route::get('/show/{id}','BranchController@show')->name('branch.show');
            Route::post('/update/{id}','BranchController@update')->name('branch.update');
            Route::post('/{id}','BranchController@destroy')->name('branch.destroy');
            Route::post('/status/{id}', 'BranchController@updateStatus')->name('branch.status');
        });
    });
});
