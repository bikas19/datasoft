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

Route::get('/','PagesController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/add-to-cart/{id}','CartItemController@store');

Route::get('/cart','CartItemController@index');

Route::get('/place-order','OrderController@create');
Route::post('/place-order','OrderController@store');


Route::post('/cart/{id}','CartItemController@update');

Route::get('/cart/{id}/delete','CartItemController@destroy');

Route::get('/food/{id}',function(){})->name('food.show');

Route::prefix('backend')->group(function(){
    Route::get('add-food','FoodController@create');
    Route::post('add-food','FoodController@store');

    Route::get('delete-food/{id}','FoodController@destroy')->name('delete-food');
});
