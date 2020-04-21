<?php

namespace Modules\Category\Repositories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * Định nghĩa constant
	 * Trạng thái:	1: ACTIVE - 2: DEACTIVE - 3: DELETE
	 * Phân loại: 1: PRODUCT - 2: MENU - 3: NEWS - 4: OTHER
	 */
	const ACTIVE     = 1;
	const DEACTIVE   = 2;
	const DELETE     = 3;

	const TYPE_PRODUCT = 1;
	const TYPE_POST    = 2;
	const TYPE_STATIC  = 3;

   	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public $table = 'categories';

	protected $guarded = ['id'];


	public function getId() {
		return $this->id;
	}

	public function getActive() {
		return $this->active;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getSlug()
	{
		return $this->slug ? $this->slug : removeTitle($this->getName());
	}

	public function getParentId()
	{
		return (int) $this->parent_id;
	}

	public function getImage()
	{
		return $this->background;
	}

	public function getImageAlt()
	{
		return $this->background_image_alt;
	}

	public function hasImage()
	{
		return $this->background ? true : false;
	}

	public function getImageHomePage()
	{
		return $this->background_homepage;
	}

	public function getUrl()
	{
		return;
	}

	public function getShortDescription()
	{
		return $this->short_description;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getSort()
	{
		return $this->sort;
	}


	public function getDescription()
	{
		return $this->description;
	}


	/**
	 * Vị trí ảnh muốn hiển thị trên menu
	 * right,left
	 * @return string
	 */
	public function getPositionImageInMenu()
	{
		return $this->position_image_in_menu;
	}

	public function presenter()
	{
		return new Presenter($this);
	}

	public function brands()
	{
		return $this->belongsToMany('App\Hocs\Brands\Brand', 'categories_brands', 'category_id', 'brand_id');
	}
}

