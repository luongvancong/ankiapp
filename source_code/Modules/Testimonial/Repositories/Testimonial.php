<?php

namespace Modules\Testimonial\Repositories;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {

    protected $table = 'testimonials';

    protected $guarded = ['id', '_token'];

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getProfession()
    {
        return $this->profession;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function presenter()
    {
        return new Presenter($this);
    }
}