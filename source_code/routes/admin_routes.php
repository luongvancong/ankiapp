<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

	/**
	 * Admin auth page
	 */
	Route::get('login', [
		'as' => 'admin.login',
		'uses' => 'AuthController@login'
	]);

	Route::post('login', [
		'as' => 'admin.doLogin',
		'uses' => 'AuthController@authenticate'
	]);

	Route::get('logout', [
		'as' => 'admin.logout',
		'uses' => 'AuthController@logout'
	]);

	Route::group(['middleware' => ['admin', 'acl']], function() {
		/**
		 * Dashboard
		 */
		Route::get('dashboard', [
			'as'          => 'dashboard',
			'uses'        => 'AuthController@dashboard',
			'permissions' => ['dashboard:view']
		]);
	});
});
