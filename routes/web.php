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

Route::group(['prefix' => 'gacha'], function () {
    Route::get('', 'GachaController@index');
    Route::post('store', 'GachaController@store');
    Route::post('delete', 'GachaController@delete');
    Route::post('update', 'GachaController@update');
});

Route::group(['prefix' => 'player-gacha'], function () {
    Route::get('', 'PlayerGachaController@index');
    Route::post('gacha', 'PlayerGachaController@store');
    Route::post('result', 'Playe$bachaController@result');
});
