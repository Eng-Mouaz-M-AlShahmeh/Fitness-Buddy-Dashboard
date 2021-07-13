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

//Route::prefix('coupon')->group(function() {
//    Route::get('/', 'CouponController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setLocale')->group(function (){
Route::prefix('coupon')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'CouponController@index')->name('coupon.index');
            Route::get('/create','CouponController@create')->name('coupon.create');
            Route::post('/store','CouponController@store')->name('coupon.store');
            Route::get('/edit/{id}','CouponController@edit')->name('coupon.edit');
            Route::post('/update/{id}','CouponController@update')->name('coupon.update');
            Route::post('/{id}','CouponController@destroy')->name('coupon.destroy');
            Route::post('/status/{id}', 'CouponController@updateStatus')->name('coupon.status');
        });
    });
});
