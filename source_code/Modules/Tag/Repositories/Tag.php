<?php

namespace Modules\Tag\Repositories;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $table = 'tags';

    protected $guarded = ['id', '_token'];

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug ? $this->slug : removeTitle($this->getName());
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

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}