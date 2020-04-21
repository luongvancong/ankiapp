<?php

namespace Modules\Product\Repositories\Category;

use Modules\Category\Repositories\Presenter as CategoryPresenter;

class Presenter extends CategoryPresenter {

    public function getUrl()
    {
        return route('product.category.detail', [$this->model->getId(), $this->model->getSlug()]);
    }
}