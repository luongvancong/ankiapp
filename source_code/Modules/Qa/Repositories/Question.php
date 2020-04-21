<?php

namespace Modules\Qa\Repositories;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

    protected $guarded = ['id'];

    public function getId()
    {
        return $this->id;
    }

    public function getUserName()
    {
        return $this->user_name;
    }

    public function getUserEmail()
    {
        return $this->user_email;
    }

    public function getUserPhone()
    {
        return $this->user_phone;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getUrl()
    {
        return route('frontend.hoidap.detail', $this->id);
    }

    public function answers()
    {
        return $this->hasMany('Modules\Qa\Repositories\Answer', 'question_id');
    }
}