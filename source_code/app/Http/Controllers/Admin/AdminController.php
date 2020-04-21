<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Auth\Guard as Auth;
use Modules\User\Repositories\UserRepository;
use App\Http\Controllers\BackendController;

class AdminController extends BackendController {

	/**
	 * Keep track logged user
	 */
	protected $auth;

	/**
	 * Current user
	 */
	protected $logger;

	public function __construct()
	{
		$this->auth = \App::make(Auth::class);
		$this->logger = \App::make(UserRepository::class);
	}


	/**
	 * Remove null value in an array
	 * @param $data
	 * @return array
	 */
	protected function removeNullValue(array $data) {
		foreach($data as $key => $value) {
			if(is_null($value) || empty($value) || $value === '') {
				unset($data[$key]);
			}
		}
		return $data;
	}
}