<?php

Route::group(['middleware' => 'web', 'prefix' => 'resource', 'namespace' => 'Modules\Resource\Http\Controllers'], function()
{
    Route::get('/', 'ResourceController@index');
});
