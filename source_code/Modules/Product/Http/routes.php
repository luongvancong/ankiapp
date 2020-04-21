<?php

Route::group(['middleware' => 'web', 'prefix' => 'san-pham', 'namespace' => 'Modules\Product\Http\Controllers\Frontend'], function()
{
    // Chi tiết sản phẩm
    Route::get('/{id}/{slug}', ['as' => 'product.detail', 'uses' => 'ProductController@getDetail']);
});


Route::group(['middleware' => 'web', 'prefix' => 'danh-muc-san-pham', 'namespace' => 'Modules\Product\Http\Controllers\Frontend'], function()
{
    // Chi tiết danh mục
    Route::get('/{id}/{slug}', ['as' => 'product.category.detail', 'uses' => 'CategoryController@getDetail']);
});