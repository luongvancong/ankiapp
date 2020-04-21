<?php

namespace Modules\Post\Repositories\Category;

use Modules\Category\Repositories\Presenter as CategoryPresenter;

class Presenter extends CategoryPresenter {
    public function __construct (PostCategory $model)
    {
        $this->model = $model;
    }

    public function getUrl()
    {
        return route('post.category.post', [$this->model->getId(), $this->model->getSlug()]);
    }
}