<?php

namespace Modules\Setting\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Model Setting
 * @author SaturnLai - daolvcntt@gmail.com
 */
class Setting extends Model
{
   /**
	* The database table used by the model.
	*
	* @var string
	*/
	public $timestamps 	= false;

	protected $guarded = ['id'];


	public function getLogo()
	{
		return $this->logo;
	}

	public function presenter()
	{
		return new Presenter($this);
	}

	public function renderControl($attributes = [])
	{
		$setting = $this;
		return view('setting::control', compact('setting'));
	}
}
