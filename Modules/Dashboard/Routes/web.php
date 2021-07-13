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
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('SetLocale')->group(function (){
Route::prefix('dashboard')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
});
    });
    Route::get('/logout', 'DashboardController@logout')->name('logout');
    Route::get('/profile','DashboardController@editProfile')->name('admin.profile');
    Route::post('/update-profile/{id}', 'DashboardController@updateProfile')->name('admin.profile.update');

});
//});
