<?php

Route::group(['prefix' => 'admin/testimonial', 'middleware' => ['web', 'admin', 'acl'], 'namespace' => 'Modules\Testimonial\Http\Controllers\Admin'], function() {

    Route::get('/index', ['as' => 'admin.testimonial.index', 'permissions' => 'testimonial:view', 'uses' => 'TestimonialController@getIndex']);

    Route::get('/create', ['as' => 'admin.testimonial.create', 'permissions' => 'testimonial:create', 'uses' => 'TestimonialController@getCreate']);
    Route::post('/create', 'TestimonialController@postCreate');

    Route::get('/{id}/edit', ['as' => 'admin.testimonial.edit', 'permissions' => 'testimonial:edit', 'uses' => 'TestimonialController@getEdit']);
    Route::post('/{id}/edit', 'TestimonialController@postEdit');

    Route::get('/{id}/delete', ['as' => 'admin.testimonial.delete', 'permissions' => 'testimonial:delete', 'uses' => 'TestimonialController@getDelete']);
});