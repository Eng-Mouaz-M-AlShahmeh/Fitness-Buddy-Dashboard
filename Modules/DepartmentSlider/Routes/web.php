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

//Route::prefix('departmentslider')->group(function() {
//    Route::get('/', 'DepartmentSliderController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('departmentslider')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'DepartmentSliderController@index')->name('dept.slider.index');
            Route::get('/create','DepartmentSliderController@create')->name('dept.slider.create');
            Route::post('/store','DepartmentSliderController@store')->name('dept.slider.store');
            Route::get('/edit/{id}','DepartmentSliderController@edit')->name('dept.slider.edit');
            Route::get('/show/{id}','DepartmentSliderController@show')->name('dept.slider.show');
            Route::post('/update/{id}','DepartmentSliderController@update')->name('dept.slider.update');
            Route::post('/{id}','DepartmentSliderController@destroy')->name('dept.slider.destroy');
            Route::post('/status/{id}', 'DepartmentSliderController@updateStatus')->name('dept.slider.status');
        });
    });
});
