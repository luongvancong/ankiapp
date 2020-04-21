<?php

namespace Modules\Setting\Repositories;

class Presenter {

    /**
     * Setting model
     * @var \Modules\Setting\Repositories\Setting
     */
    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function getLogo($type = 'md_')
    {
        return parse_file_url($type . $this->model->getLogo());
    }
}