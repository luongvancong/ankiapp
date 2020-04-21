<?php

namespace Modules\Qa\Repositories;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

    protected $guarded = ['id', '_token'];

    public function getId()
    {
        return $this->id;
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
        return new AnswerPresenter($this);
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function author()
    {
        return $this->belongsTo('Modules\User\Repositories\User', 'respondent_id');
    }

    public function question()
    {
        return $this->belongsTo('Modules\Qa\Repositories\Question', 'question_id');
    }
}