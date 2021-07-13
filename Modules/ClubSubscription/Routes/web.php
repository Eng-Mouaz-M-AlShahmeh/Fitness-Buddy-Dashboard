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

//Route::prefix('clubsubscription')->group(function() {
//    Route::get('/', 'ClubSubscriptionController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('club')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('subscription/', 'ClubSubscriptionController@index')->name('clubsubscription.index');
            Route::get('subscription/create','ClubSubscriptionController@create')->name('clubsubscription.create');
            Route::post('subscription/store','ClubSubscriptionController@store')->name('clubsubscription.store');
            Route::get('subscription/edit/{id}','ClubSubscriptionController@edit')->name('clubsubscription.edit');
            Route::post('subscription/update/{id}','ClubSubscriptionController@update')->name('clubsubscription.update');
            Route::post('subscription/{id}','ClubSubscriptionController@destroy')->name('clubsubscription.destroy');
        });
    });
});
//});
