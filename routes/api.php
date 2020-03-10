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
    Route::post('/create', 'NewsController@create');
    Route::put('/{id}', 'NewsController@update');
    Route::delete('/{id}', 'NewsController@destroy');
});

Route::group(['prefix' => 'authors'],function () {

    Route::get('/', 'AuthorController@index');
    Route::get('/{id}', 'AuthorController@show')->where('id', '[0-9]+');
    Route::post('/create', 'AuthorController@create');
    Route::put('/{id}', 'AuthorController@update');
    Route::delete('/{id}', 'AuthorController@destroy');
    Route::get('/suggest','AuthorController@suggest');
});
