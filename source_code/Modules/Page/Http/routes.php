<?php

Route::group(['middleware' => 'web', 'prefix' => 'page', 'namespace' => 'Modules\Page\Http\Controllers\Frontend'], function()
{
    Route::get('/{id}-{slug}', ['as' => 'page.detail', 'uses' => 'PageController@getDetail']);
});
