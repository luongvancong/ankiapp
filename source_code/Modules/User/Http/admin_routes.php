<?php

/**
 * Users module
 */
Route::group(['prefix' => 'admin/users', 'middleware' => ['web', 'admin', 'acl'], 'namespace' => 'Modules\User\Http\Controllers\Admin'], function() {
    Route::get('/', [
        'as' => 'user.index',
        'uses' => 'UserController@index',
        'permissions' => 'user:view',
    ]);

    Route::get('create', [
        'as' => 'user.create',
        'uses' => 'UserController@create',
        'permissions' => 'user:create',
    ]);

    Route::post('/', [
        'as' => 'user.store',
        'uses' => 'UserController@store',
        'permissions' => 'user:store',
    ]);

    Route::get('{id}/edit', [
        'as' => 'user.edit',
        'uses' => 'UserController@edit',
        'permissions' => 'user:edit',
    ]);

    Route::post('{id}/edit', [
        'as' => 'user.update',
        'uses' => 'UserController@update',
        'permissions' => 'user:update',
    ]);

    Route::get('{user}/delete', [
        'as' => 'user.destroy',
        'uses' => 'UserController@destroy',
        'permissions' => 'user:destroy',
    ]);

    // Change profile
    Route::get('/profile', ['as' => 'admin.user.profile', 'uses' => 'ProfileController@getProfile']);
    Route::post('/profile', 'ProfileController@postProfile');

    // Change password
    Route::get('/profile/change-password', ['as' => 'admin.user.profile.changePassword', 'uses' => 'ProfileController@getChangePassword']);
    Route::post('/profile/change-password', 'ProfileController@postChangePassword');
});


/**
 * Permissions module
 */
Route::group(['prefix' => 'admin/users/permissions', 'middleware' => ['web', 'admin', 'acl'], 'namespace' => 'Modules\User\Http\Controllers\Admin'], function() {
    Route::get('/', [
     'as'          => 'permission.index',
     'uses'        => 'PermissionController@index',
     'permissions' => 'permission:view',
    ]);

    Route::get('create', [
        'as'          => 'permission.create',
        'uses'        => 'PermissionController@create',
        'permissions' => 'permission:create',
    ]);

    Route::post('/create', [
        'as'          => 'permission.store',
        'uses'        => 'PermissionController@store',
        'permissions' => 'permission:store',
    ]);

    Route::get('{permission}/edit', [
        'as'          => 'permission.edit',
        'uses'        => 'PermissionController@edit',
        'permissions' => 'permission:edit',
    ]);

    Route::post('{permission}/edit', [
        'as'          => 'permission.update',
        'uses'        => 'PermissionController@update',
        'permissions' => 'permission:update',
    ]);

    Route::get('{permission}/delete', [
        'as'          => 'permission.destroy',
        'uses'        => 'PermissionController@destroy',
        'permissions' => 'permission:destroy',
    ]);
});