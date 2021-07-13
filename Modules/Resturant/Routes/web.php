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

//Route::prefix('resturant')->group(function() {
//    Route::get('/', 'ResturantController@index');
//});
Route::get('/changeLanguagee/{lang}', function ($lang) {
    $lang == 'en' ? Session::put('lang','ar') : Session::put('lang','en');

    return back();
});
//Route::middleware('setlocale')->group(function (){
Route::prefix('resturant')->group(function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {
            Route::get('/', 'ResturantController@index')->name('resturant.index');
            Route::get('/create','ResturantController@create')->name('resturant.create');
            Route::post('/store','ResturantController@store')->name('resturant.store');
            Route::get('/edit/{id}','ResturantController@edit')->name('resturant.edit');
            Route::get('/show/{id}','ResturantController@show')->name('resturant.show');
            Route::post('/update/{id}','ResturantController@update')->name('resturant.update');
            Route::post('/{id}','ResturantController@destroy')->name('resturant.destroy');
            Route::post('/status/{id}', 'ResturantController@updateStatus')->name('resturant.status');
            
            Route::get('info/{id}', 'ResturantController@info')->name('resturant.info');
            Route::get('slider/create/{id}','ResturantController@createResturantSlider')->name('resturant.sliders.create');
            Route::post('slider/store/{id}','ResturantController@storeResturantSlider')->name('resturant.sliders.store');
            Route::get('branch/create/{id}','ResturantController@createResturantBranch')->name('resturant.branches.create');
            Route::post('branch/store/{id}','ResturantController@storeResturantBranch')->name('resturant.branches.store');
            Route::get('category/create/{id}','ResturantController@createResturantCategory')->name('resturant.categories.create');
            Route::post('category/store/{id}','ResturantController@storeResturantCategory')->name('resturant.categories.store');
            
            Route::get('mealinfo/{id}', 'ResturantController@mealInfo')->name('resturant.meal.info');
            //Route::get('modifier/create/{id}','ResturantController@createModifier')->name('resturant.meal.modifier.create');
            //Route::post('modifier/store/{id}','ResturantController@storeModifier')->name('resturant.meal.modifier.store');
            
            Route::get('mealModifier/create/{id}','ResturantController@createMealModifier')->name('resturant.meal.modifiers.create');
            Route::post('mealModifier/store/{id}','ResturantController@storeMealModifier')->name('resturant.meal.modifiers.store');
            
            Route::get('mealIngredients/create/{id}','ResturantController@createMealIngredients')->name('resturant.meal.ingredients.create');
            Route::post('mealIngredients/store/{id}','ResturantController@storeMealIngredients')->name('resturant.meal.ingredients.store');
            
            Route::get('meal/create/{id}','ResturantController@createMeal')->name('resturant.meals.create');
            Route::post('meal/store/{id}','ResturantController@storeMeal')->name('resturant.meals.store');
            
            
            
        });
    });
});
//});
