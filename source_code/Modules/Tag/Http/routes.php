<?php

Route::group(['middleware' => 'web', 'prefix' => 'tag', 'namespace' => 'Modules\Tag\Http\Controllers\Frontend'], function()
{
    Route::get('/{slug}', ['as' => 'tag.single', 'uses' => 'TagController@index']);
});
