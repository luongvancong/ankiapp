<?php

Route::group(['prefix' => '/post', 'middle_ware' => ['web']], function() {
    // Danh sách tin tức
    Route::get('/', ['uses' => 'Modules\Post\Http\Controllers\Frontend\PostController@getIndex']);

    // Chi tiết tin tức
    Route::get('/{id}-{slug}', ['as' => 'post.detail', 'uses' => 'Modules\Post\Http\Controllers\Frontend\PostController@getDetail']);
});


Route::group(['prefix' => '/post-category', 'middle_ware' => ['web']], function() {

    // Tin tức trong danh mục
    Route::get('/{id}-{slug}', ['as' => 'post.category.post', 'uses' => 'Modules\Post\Http\Controllers\Frontend\PostCategoryController@getIndex']);
});