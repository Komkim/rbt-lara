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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'news'],function () {

    Route::get('/', 'NewsController@index');
    Route::get('/{id}', 'NewsController@show');
    Route::post('/create', 'NewsController@create');
    Route::put('/{id}', 'NewsController@update');
    Route::delete('/{id}', 'NewsController@destroy');
});

Route::group(['prefix' => 'author'],function () {

    Route::get('/', 'AuthorController@index');
    Route::get('/{id}', 'AuthorController@show');
    Route::post('/create', 'AuthorController@create');
    Route::put('/{id}', 'AuthorController@update');
    Route::delete('/{id}', 'AuthorController@destroy');
});
