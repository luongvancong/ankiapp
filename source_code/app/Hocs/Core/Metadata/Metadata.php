<?php
namespace App\Hocs\Core\Metadata;

use Modules\Setting\Repositories\SettingRepository;

class Metadata {

	protected $attributes = [];

	public function __construct(SettingRepository $set) {
		$settings = $set->getAllActive();
		foreach($settings as $row) {
			$this->attributes[$row->key] = $row->value;
		}
	}

	public function __set($key, $value)
	{
		$this->attributes[$key] = $value;
	}

	public function __get($key)
	{
		return array_get($this->attributes, $key);
	}

	public function toArray()
	{
		return $this->attributes;
	}
}