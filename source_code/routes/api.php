<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'me'], function() {
       Route::get('/', 'MeController@getMe');
       Route::get('/desks', 'DeskController@index');
    });

    Route::group(['prefix' => 'desks'], function() {
        Route::post('/', 'DeskController@store');
        Route::get('/{id}', 'DeskController@show');
        Route::patch('/{id}', 'DeskController@update');
        Route::delete('/{id}', 'DeskController@destroy');
        Route::get('/{id}/study', 'DeskController@study');
    });

    Route::group(['prefix' => 'cards'], function() {
        Route::get('/', 'CardController@index');
        Route::post('/', 'CardController@store');
        Route::get('/{id}', 'CardController@show');
        Route::patch('/{id}', 'CardController@update');
        Route::delete('/{id}', 'CardController@destroy');
    });
});