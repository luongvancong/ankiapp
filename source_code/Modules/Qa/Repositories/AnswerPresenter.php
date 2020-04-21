<?php

namespace Modules\Qa\Repositories;

class AnswerPresenter {

    /**
     * Answer
     * @var \Modules\Qa\Repositories\Answer
     */
    protected $model;

    public function __construct(Answer $model)
    {
        $this->model = $model;
    }

    public function getDate()
    {
        return date('d/m/Y', strtotime($this->model->getCreatedAt()));
    }
}