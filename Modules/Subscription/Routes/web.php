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

//Route::prefix('subscription')->group(function() {
//    Route::get('/', 'SubscriptionController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('subscription')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'SubscriptionController@index')->name('subscriptions.index');
            Route::get('/create','SubscriptionController@create')->name('subscriptions.create');
            Route::post('/store','SubscriptionController@store')->name('subscriptions.store');
            Route::get('/edit/{id}','SubscriptionController@edit')->name('subscriptions.edit');
            Route::post('/update/{id}','SubscriptionController@update')->name('subscriptions.update');
            Route::post('/{id}','SubscriptionController@destroy')->name('subscriptions.destroy');
            Route::post('/status/{id}', 'SubscriptionController@updateStatus')->name('subscriptions.status');
        });
    });
});
//});
