<?php

Route::group(['prefix' => 'admin/banners', 'middleware' => ['web', 'admin', 'acl'], 'namespace' => 'Modules\Banner\Http\Controllers\Admin'], function() {
    Route::get('/', [
        'as'          => 'admin.banner.index',
        'uses'        => 'BannerController@index',
        'permissions' => 'banner:view'
    ]);

    Route::get('/create',  [
        'as'          => 'admin.banner.create',
        'uses'        => 'BannerController@create',
        'permissions' => 'banner:create'
    ]);

    Route::post('/create', [
        'as'          => 'admin.banner.store',
        'uses'        =>'BannerController@store',
        'permissions' => 'banner:create'
    ]);

    Route::get('{id}/edit',  [
        'as'          => 'admin.banner.edit',
        'uses'        => 'BannerController@edit',
        'permissions' => 'banner:edit'
    ]);

    Route::post('{id}/edit', [
        'as'          => 'admin.banner.update',
        'uses'        =>'BannerController@update',
        'permissions' => 'banner:edit'
    ]);

    Route::get('{id}/active', [
        'as'          => 'admin.banner.active',
        'uses'        => 'BannerController@active',
        'permissions' => 'banner:edit'
    ]);

    Route::get('{id}/delete', [
        'as'          => 'admin.banner.destroy',
        'uses'        => 'BannerController@destroy',
        'permissions' => 'banner:destroy'
    ]);


    // Ajax editable
    Route::post('/ajax/editable', ['as' => 'admin.banner.ajax.editable', 'uses' => 'BannerController@ajaxEditAble']);
});