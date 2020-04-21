<?php

Route::group(['middleware' => ['web', 'admin', 'acl'], 'prefix' => 'admin/menu', 'namespace' => 'Modules\Menu\Http\Controllers\Admin'], function()
{
    Route::get('', ['as' => 'admin.menu.index', 'uses' => 'MenuController@getIndex']);

    Route::get('/create', ['as' => 'admin.menu.create', 'uses' => 'MenuController@getCreate']);
    Route::post('/create', 'MenuController@postCreate');

    Route::get('/{id}/edit', ['as' => 'admin.menu.edit', 'uses' => 'MenuController@getEdit']);
    Route::post('/{id}/edit', 'MenuController@postEdit');

    Route::get('/{id}/delete', ['as' => 'admin.menu.delete', 'uses' => 'MenuController@getDelete']);

    Route::get('/{id}/active', ['as' => 'admin.menu.active', 'uses' => 'MenuController@getActive']);

    // Optimize
    Route::get('/optimize', ['as' => 'admin.menu.optimize', 'uses' => 'MenuController@getOptimize']);

    // Thiết kế menu
    Route::get('/design', ['as' => 'admin.menu.design', 'uses' => 'MenuController@getDesign']);
    Route::post('/design', 'MenuController@postDesign');

    // Ajax editable
    Route::post('/ajax/editable', ['as' => 'admin.menu.ajax.editable', 'uses' => 'MenuController@ajaxEditable']);

    // Ajax search post
    Route::get('/ajax/search-post', ['as' => 'admin.menu.ajax.searchPost', 'uses' => 'MenuController@ajaxSearchPost']);

    // Ajax search post-category
    Route::get('/ajax/search-post-category', ['as' => 'admin.menu.ajax.searchPostCategory', 'uses' => 'MenuController@ajaxSearchPostCategory']);

    // Ajax search page
    Route::get('/ajax/search-page', ['as' => 'admin.menu.ajax.searchPage', 'uses' => 'MenuController@ajaxSearchPage']);
});
