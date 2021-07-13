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

//Route::prefix('department')->group(function() {
//    Route::get('/', 'DepartmentController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('department')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'DepartmentController@index')->name('departments.index');
            Route::get('/create','DepartmentController@create')->name('departments.create');
            Route::post('/store','DepartmentController@store')->name('departments.store');
            Route::get('/edit/{id}','DepartmentController@edit')->name('departments.edit');
            Route::post('/update/{id}','DepartmentController@update')->name('departments.update');
            Route::post('/{id}','DepartmentController@destroy')->name('departments.destroy');
            Route::post('/status/{id}', 'DepartmentController@updateStatus')->name('departments.status');
        });
    });
});
//});
