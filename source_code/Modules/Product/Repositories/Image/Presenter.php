<?php

namespace Modules\Product\Repositories\Image;

class Presenter {

    public function __construct(ProductImage $model)
    {
        $this->model = $model;
    }

    public function getImage($type = '')
    {
        return parse_file_url($type . $this->model->getImage());
    }

}