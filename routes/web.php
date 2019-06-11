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
Route::get('/','AndroidController@indexx');
Route::group(["middleware"=>"auth"],function(){
    Route::get('/admi', 'RefererController@index');
    Route::get('/add', 'RefererController@create');
    Route::post('/add', 'RefererController@store');
    Route::get('/users', 'RefererController@Allusers');
    Route::get('/transact', 'RefererController@transact');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::get('pay/{id}','PaymentController@pay'); 
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');