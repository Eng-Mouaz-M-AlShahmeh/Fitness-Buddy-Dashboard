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
//Route::prefix('departmentplan')->group(function() {
//    Route::get('/', 'DepartmentPlanController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('departmentplan')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'DepartmentPlanController@index')->name('dept.plan.index');
            Route::get('/create','DepartmentPlanController@create')->name('dept.plan.create');
            Route::post('/store','DepartmentPlanController@store')->name('dept.plan.store');
            Route::get('/edit/{id}','DepartmentPlanController@edit')->name('dept.plan.edit');
            Route::post('/update/{id}','DepartmentPlanController@update')->name('dept.plan.update');
            Route::post('/{id}','DepartmentPlanController@destroy')->name('dept.plan.destroy');
        });
    });
});
//});
