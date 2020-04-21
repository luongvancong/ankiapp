<?php

namespace Modules\Testimonial\Repositories;

class Presenter {

    /**
     * @var \Modules\Testimonial\Repositories\Testimonial
     */
    protected $model;

    public function __construct(Testimonial $model)
    {
        $this->model = $model;
    }

    public function getAvatar($type = '')
    {
        return parse_file_url($type . $this->model->getAvatar());
    }
}