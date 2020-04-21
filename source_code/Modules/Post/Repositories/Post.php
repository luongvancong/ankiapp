<?php

namespace Modules\Post\Repositories;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $primaryKey = 'id';

	public $guarded = ['id', '_token', 'tag'];

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

	public function getContent() {
		$content = $this->content;
		return $content;
	}


	public function hasImage()
	{
		return $this->image ? true : false;
	}

	public function getImage()
	{
		return $this->image;
	}

	public function getImageAlt()
	{
		return $this->image_alt;
	}

	public function getCategoryId()
	{
		return $this->category_id;
	}

	public function getCreatedAt()
	{
		return $this->created_at;
	}

	public function getUpdatedAt() {
		return $this->updated_at;
	}

	public function getTags()
	{
		return $this->tags;
	}

	public function getArrayTags()
	{
		return explode(',', $this->tags);
	}

	public function hasTags()
	{
		return $this->tags ? true : false;
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

	public function presenter()
	{
		return new Presenter($this);
	}

	public function tags()
	{
		return $this->belongsToMany('Modules\Tag\Repositories\Tag', 'posts_tags', 'post_id');
	}

	public function comments() {
		return $this->hasMany('App\Hocs\Posts\PostComment', 'post_id');
	}

	public function author()
	{
		return $this->belongsTo('Modules\User\Repositories\User', 'user_id');
	}

	public function category()
	{
		return $this->belongsTo('Modules\Post\Repositories\Category\PostCategory', 'category_id');
	}
}
