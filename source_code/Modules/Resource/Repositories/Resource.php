<?php

namespace Modules\Resource\Repositories;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model {
    protected $guarded = ['id'];

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getAlt()
    {
        return $this->alt;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }
}