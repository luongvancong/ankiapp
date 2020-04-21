<?php

namespace Modules\Product\Repositories;

class ProductPresenter {

    /**
     * Model
     * @param \Modules\Product\Repositories\Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getPrice()
    {
        return formatCurrency($this->model->getPrice());
    }

    public function getPromotionPrice() {
        return formatCurrency($this->model->getPromotionPrice());
    }

    public function getImage($type = '')
    {
        return parse_file_url($type . $this->model->getImage());
    }

    public function getUrl()
    {
        return route('product.detail', [$this->model->getId(), $this->model->getSlug()]);
    }
}