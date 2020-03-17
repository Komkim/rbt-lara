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
Route::get('/', 'NewsController@index');

Route::group(['prefix' =>'news'],function () {
    Route::get('/', 'NewsController@index');
    Route::get('/{id}', 'NewsController@show');
    Route::delete('/{id}', 'NewsController@destroy');
});

