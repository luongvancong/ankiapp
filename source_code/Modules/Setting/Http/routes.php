<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Setting\Http\Controllers'], function()
{
    Route::group(['prefix' => 'settings'], function() {
        Route::get('website', [
            'as'          => 'website.edit',
            'uses'        => 'SettingController@edit',
            'permissions' => 'setting:view',
        ]);

        Route::post('website', [
            'as'          => 'website.update',
            'uses'        => 'SettingController@update',
            'permissions' => 'setting:edit',
        ]);

        Route::get('metadata', [
            'as'   => 'metadata.show',
            'uses' => 'SettingController@metadata',
            'permissions' => 'setting:view',
        ]);

        Route::post('metadata', [
            'as'   => 'metadata.post.edit',
            'uses' => 'SettingController@postMetadata',
            'permissions' => 'setting:edit',
        ]);

        Route::get('social', [
            'as'   => 'social.show',
            'uses' => 'SettingController@social',
            'permissions' => 'setting:view',
        ]);

        Route::post('social', [
            'as'   => 'social.post.edit',
            'uses' => 'SettingController@postSocial',
            'permissions' => 'setting:edit',
        ]);
    });
});
