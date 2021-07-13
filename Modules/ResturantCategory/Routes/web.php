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

//Route::prefix('resturantcategory')->group(function() {
//    Route::get('/', 'ResturantCategoryController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('resturant')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
//            Route::get('/category', 'ResturantCategoryController@index')->name('resturant.categories.index');
//            Route::get('category/create','ResturantCategoryController@create')->name('resturant.categories.create');
//            Route::post('category/store','ResturantCategoryController@store')->name('resturant.categories.store');
            Route::get('category/edit/{id}','ResturantCategoryController@edit')->name('resturant.categories.edit');
            Route::post('category/update/{id}','ResturantCategoryController@update')->name('resturant.categories.update');
            Route::post('category/{id}','ResturantCategoryController@destroy')->name('resturant.categories.destroy');
            Route::post('category/status/{id}', 'ResturantCategoryController@updateStatus')->name('resturant.categories.status');
        });
    });
});
//});
