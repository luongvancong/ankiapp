<?php

Route::group(['prefix' => 'admin/post', 'middleware' => ['web', 'admin', 'acl'], 'namespace' => 'Modules\Post\Http\Controllers\Admin'], function() {
    Route::get('/index', ['as' => 'admin.post.index', 'permissions' => 'post:view' ,'uses' => 'PostController@getIndex']);

    Route::get('/create', ['as' => 'admin.post.create', 'permissions' => 'post:create' ,'uses' => 'PostController@getCreate']);
    Route::post('/create', ['permissions' => 'post:create', 'uses' => 'PostController@postCreate']);

    Route::get('/{postId}/edit', ['as' => 'admin.post.edit', 'permissions' => 'post:view' ,'uses' => 'PostController@getEdit']);
    Route::post('/{postId}/edit', ['permissions' => 'post:edit', 'uses' => 'PostController@postEdit']);

    Route::get('/{postId}/active', ['as' => 'admin.post.active', 'uses' => 'PostController@getActive']);

    Route::get('/{postId}/delete', ['as' => 'admin.post.delete', 'permissions' => 'post:delete' ,'uses' => 'PostController@getDelete']);

    Route::get('/{postId}/tag', ['as' => 'admin.post.tag.index', 'permissions' => 'post:edit' ,'uses' => 'PostController@tagIndex']);

    Route::get('/{postId}/tag/create', ['as' => 'admin.post.tag.create', 'permissions' => 'post:edit' ,'uses' => 'PostController@tagCreate']);
    Route::post('/{postId}/tag/create', ['permissions' => 'post:edit', 'uses' => 'PostController@tagCreateStore']);

    Route::get('/{postId}/tag/{tagId}/delete', ['as' => 'admin.post.tag.delete', 'permissions' => 'post:edit' ,'uses' => 'PostController@tagDelete']);

    Route::post('/ajax/editable', ['as' => 'admin.post.ajax.editable', 'permissions' => 'post:edit', 'uses' => 'PostController@ajaxEditAble']);

});

// Post category
Route::group(['prefix' => 'admin/post-category', 'middleware' => ['web', 'admin', 'acl'], 'namespace' => 'Modules\Post\Http\Controllers\Admin'], function() {
    Route::get('/index', ['as' => 'admin.post_category.index', 'permissions' => 'post_category:view' ,'uses' => 'PostCategoryController@getIndex']);
    Route::get('/create', ['as' => 'admin.post_category.create', 'permissions' => 'post_category:view' ,'uses' => 'PostCategoryController@getCreate']);
    Route::post('/create', ['permissions' => 'post_category:create', 'uses' => 'PostCategoryController@postCreate']);

    Route::get('/{id}/edit', ['as' => 'admin.post_category.edit', 'permissions' => 'post_category:view' ,'uses' => 'PostCategoryController@getEdit']);
    Route::post('/{id}/edit', ['permissions' => 'post_category:edit', 'uses' => 'PostCategoryController@postEdit']);

    Route::get('/{id}/delete', ['as' => 'admin.post_category.delete', 'permissions' => 'post_category:delete' ,'uses' => 'PostCategoryController@getDelete']);

    Route::get('/optimize', ['as' => 'admin.post_category.optimize', 'permissions' => 'post_category:edit', 'uses' => 'PostCategoryController@getOptimize']);
});