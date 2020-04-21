<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Frontend\Auth'], function() {
    Route::get('/login', ['as' => 'auth.login', 'uses' => 'LoginController@getLogin']);
    Route::post('/login', 'LoginController@postLogin');

    Route::get('/register', ['as' => 'auth.register', 'uses' => 'RegisterController@getRegister']);
    Route::post('/register', 'RegisterController@postRegister');
});