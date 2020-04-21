<?php

Route::group(['prefix' => 'admin/resource', 'middleware' => ['web', 'acl'], 'namespace' => 'Modules\Resource\Http\Controllers\Admin'], function() {
    Route::get('/', ['as' => 'admin.resource.index', 'permissions' => 'resource:view', 'uses' => 'ResourceController@getIndex']);

    // Create
    Route::get('/create', ['as' => 'admin.resource.create', 'permissions' => 'resource:create', 'uses' => 'ResourceController@getCreate']);
    Route::post('/create', ['permissions' => 'resource:create', 'uses' => 'ResourceController@postCreate']);

    // edit
    Route::get('/{id}/edit', ['as' => 'admin.resource.edit', 'permissions' => 'resource:edit', 'uses' => 'ResourceController@getEdit']);
    Route::post('/{id}/edit', ['permissions' => 'resource:edit', 'uses' => 'ResourceController@postEdit']);

    // delete
    Route::get('/{id}/delete', ['as' => 'admin.resource.delete', 'permissions' => 'resource:delete', 'uses' => 'ResourceController@getDelete']);

    // Editable
    Route::post('/ajax/editable', ['as' => 'admin.resource.ajax.editable', 'permissions' => 'resource:edit', 'uses' => 'ResourceController@ajaxEditable']);


    // Gallery
    Route::group(['prefix' => 'gallery'], function() {
        Route::get('index', ['as' => 'admin.gallery.index', 'uses' => 'GalleryController@getIndex']);
        Route::post('delete', ['as' => 'admin.gallery.delete', 'uses' => 'GalleryController@getDelete']);
        Route::post('/ajax/upload-image', ['as' => 'admin.gallery.upload', 'uses' => 'GalleryController@ajaxUploadImage']);
        Route::post('/ajax/upload-images', ['as' => 'admin.gallery.uploads', 'uses' => 'GalleryController@ajaxUploadImages']);
    });
});