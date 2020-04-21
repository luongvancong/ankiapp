<?php

namespace Modules\Tag\Repositories;

class Presenter {

    /**
     * Tag
     * @var \Modules\Tag\Repositories\Tag
     */
    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getUrl()
    {
        return route('tag.single', $this->model->getSlug());
    }
}