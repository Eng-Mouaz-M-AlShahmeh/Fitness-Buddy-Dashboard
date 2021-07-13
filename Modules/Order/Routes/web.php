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
//Route::middleware('setlocale')->group(function (){
Route::prefix('order')->group(function() {
    Route::get('/resturants', 'OrderController@resturantsIndex')->name('order.resturants.index');




    Route::get('/resturants/daily', 'OrderController@resturantsDaily')->name('order.resturants.daily');
    Route::get('/resturants/monthly', 'OrderController@resturantsMonthly')->name('order.resturants.monthly');
    Route::get('/resturants/work', 'OrderController@resturantsWork')->name('order.resturants.work');


    Route::get('/editMonthly/{id}','OrderController@editMonthly')->name('order.resturants.editMonthly');
    Route::post('/updateMonthly/{id}','OrderController@updateMonthly')->name('order.resturants.updateMonthly');


    Route::get('/editWork/{id}','OrderController@editWork')->name('order.resturants.editWork');
    Route::post('/updateWork/{id}','OrderController@updateWork')->name('order.resturants.updateWork');






    Route::get('/resturants/edit/{id}','OrderController@resturantsEdit')->name('order.resturants.edit');
    Route::get('/resturants/show/{id}','OrderController@resturantsShow')->name('order.resturants.show');
    
    Route::get('/resturants/pdf/{id}','OrderController@resturantsPdf')->name('order.resturants.pdf');
    
    
    Route::post('/resturants/status/{id}', 'OrderController@resturantsUpdateStatus')->name('order.resturants.status');
    Route::post('/resturants/{id}','OrderController@resturantsDestroy')->name('order.resturants.destroy');

    Route::get('/clubs', 'OrderController@clubsIndex')->name('order.clubs.index');













    //Route::get('/clubs/{id}/pause','OrderController@pause')->name('order.clubs.pause');
    //Route::put('/clubs/{id}','OrderController@update')->name('order.clubs.update');




    Route::get('/clubs/show/{id}','OrderController@clubsShow')->name('order.clubs.show');
    
     Route::get('/clubs/pdf/{id}','OrderController@clubsPdf')->name('order.clubs.pdf');
     
     
    Route::post('/clubs/status/{id}', 'OrderController@clubsUpdateStatus')->name('order.clubs.status');
    
    Route::get('/edit/{id}','OrderController@edit')->name('order.club.edit');
    Route::post('/update/{id}','OrderController@update')->name('order.club.update');


    Route::post('/clubs/{id}','OrderController@clubsDestroy')->name('order.clubs.destroy');

    Route::get('/trainers', 'OrderController@trainersIndex')->name('order.trainers.index');
    Route::get('/trainers/edit/{id}','OrderController@trainersEdit')->name('order.trainers.edit');
    Route::get('/trainers/show/{id}','OrderController@trainersShow')->name('order.trainers.show');
    
    Route::get('/trainers/pdf/{id}','OrderController@trainersPdf')->name('order.trainers.pdf');
    
    
    Route::post('/trainers/status/{id}', 'OrderController@TrainersOrderUpdateStatus')->name('order.trainers.status');
    Route::post('/trainers/{id}','OrderController@trainersDestroy')->name('order.trainers.destroy');

    Route::get('/nutritionists', 'OrderController@nutritionistsIndex')->name('order.nutritionists.index');
    Route::get('/nutritionists/edit/{id}','OrderController@nutritionistsEdit')->name('order.nutritionists.edit');
    Route::get('/nutritionists/show/{id}','OrderController@nutritionistsShow')->name('order.nutritionists.show');
   
   Route::get('/nutritionists/pdf/{id}','OrderController@nutritionistsPdf')->name('order.nutritionists.pdf');
   
   
    
    Route::post('/nutritionists/status/{id}', 'OrderController@nutritionistsUpdateStatus')->name('order.nutritionists.status');
    Route::post('/nutritionists/{id}','OrderController@nutritionistsDestroy')->name('order.nutritionists.destroy');
});

//});
