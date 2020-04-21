<?php

namespace Modules\Page\Repositories;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	protected $primaryKey = 'id';
	protected $table      = "pages";

	protected $guarded = ['id', '_token'];

	const PAGE_ACTIVE   = 1;
	const PAGE_DEACTIVE = 0;

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getSlug() {
		return $this->slug ? $this->slug : removeTitle($this->getTitle());
	}

	public function getTeaser() {
		return $this->teaser;
	}

	public function getActive()
	{
		return $this->active;
	}


	public function getContent() {
		return $this->content;
	}

	public function hasImage()
	{
		return $this->image ? true : false;
	}

	public function getImage() {
		return $this->image;
	}

	public function getImageAlt()
	{
		return $this->image_alt;
	}

	public function getMetaTitle()
	{
		return $this->meta_title;
	}

	public function getMetaKeyword()
	{
		return $this->meta_keyword;
	}

	public function getMetaDescription()
	{
		return $this->meta_description;
	}

	public function getCreatedAt()
	{
		return $this->created_at;
	}

	public function presenter()
	{
		return new Presenter($this);
	}
}