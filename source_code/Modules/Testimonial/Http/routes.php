<?php

Route::group(['middleware' => 'web', 'prefix' => 'testimonial', 'namespace' => 'Modules\Testimonial\Http\Controllers'], function()
{
    Route::get('/', 'TestimonialController@index');
});
