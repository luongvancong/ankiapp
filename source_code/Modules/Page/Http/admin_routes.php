<?php

Route::group(['prefix' => 'admin/page', 'middleware' => ['web', 'admin', 'acl'], 'namespace' => 'Modules\Page\Http\Controllers\Admin'], function() {
    Route::get('/', ['as' => 'admin.page.index', 'permissions' => 'page:view', 'uses' => 'PageController@getIndex']);

    // Page Create
    Route::get('/create', ['as' => 'admin.page.create', 'permissions' => 'page:create', 'uses' => 'PageController@getCreate']);
    Route::post('/create', ['permissions' => 'page:create', 'uses' => 'PageController@postCreate']);

    // Page edit
    Route::get('/{id}/edit', ['as' => 'admin.page.edit', 'permissions' => 'page:edit', 'uses' => 'PageController@getEdit']);
    Route::post('/{id}/edit', ['permissions' => 'page:edit', 'uses' => 'PageController@postEdit']);

    // Page delete
    Route::get('/{id}/delete', ['as' => 'admin.page.delete', 'permissions' => 'page:delete', 'uses' => 'PageController@getDelete']);

    // Page active
    Route::get('/{id}/active', ['as' => 'admin.page.active', 'permissions' => 'page:active', 'uses' => 'PageController@getActive']);
});