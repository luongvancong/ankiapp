<?php

Route::group(['prefix' => 'admin/categories', 'middleware' => ['web', 'admin', 'acl'], 'namespace' => 'Modules\Category\Http\Controllers\Admin'], function() {
      Route::get('/', ['as' => 'admin.category.index', 'permissions' => 'category:view' ,'uses' => 'CategoryController@index']);

      Route::get('/create', ['as' => 'admin.category.create', 'uses' => 'CategoryController@create']);
      Route::post('/create', 'CategoryController@store');

      Route::get('/{id}/edit', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@edit']);
      Route::post('/{id}/edit', 'CategoryController@update');

      Route::get('/{id}/delete', ['as' => 'admin.category.delete', 'uses' => 'CategoryController@destroy']);

      Route::get('/{id}/active', ['as' => 'admin.category.toggleActive', 'uses' => 'CategoryController@toggleActive']);

      // Xử lý ajax editable - bootstrap editable
      Route::post('/ajax/editable', ['as' => 'admin.category.ajax.editable', 'uses' => 'CategoryController@ajaxEditAble']);

});