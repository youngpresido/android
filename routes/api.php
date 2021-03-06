<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('androidapis', 'AndroidController@index');

Route::get('androidapi/{id}', 'AndroidController@show');

Route::post('androidapi', 'AndroidController@store');

Route::put('androidapi/{id}', 'AndroidController@store');
Route::delete('androidapi/{id}', 'AndroidController@destroy');




Route::post('android/create', 'AndroidController@create');
