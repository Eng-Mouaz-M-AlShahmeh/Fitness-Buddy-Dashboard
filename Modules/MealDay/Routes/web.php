<?php

Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang', 'ar') : Session::put('lang', 'en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('mealday')->group(function () {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'MealDayController@index')->name('mealday.index');
            Route::get('/create', 'MealDayController@create')->name('mealday.create');
            Route::post('/store', 'MealDayController@store')->name('mealday.store');
            Route::get('/edit/{id}', 'MealDayController@edit')->name('mealday.edit');
            Route::post('/update/{id}', 'MealDayController@update')->name('mealday.update');
            Route::post('/{id}', 'MealDayController@destroy')->name('mealday.destroy');
        });
    });
});
//});
