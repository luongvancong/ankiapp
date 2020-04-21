<?php

namespace Modules\Post\Repositories;

class Presenter {
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getDate()
    {
        return date('d/m/Y', strtotime($this->model->updated_at));
    }

    public function getTime()
    {
        return date('H:i', strtotime($this->model->updated_at));
    }

    public function getDateTimeIso8601() {
        $datetime = new \DateTime($this->updated_at);
        return $datetime->format(\DateTime::ISO8601);
    }

    public function getAuthor()
    {
        return $this->model->author->getName();
    }

    public function getUrl() {
        return route('post.detail', [ $this->model->getId(), $this->model->getSlug() ]);
    }


    public function getCanonicalUrl($category) {
        return route('post.detail', [$this->model->getId(), $this->model->getSlug()]);
    }

    public function getImage($type = 'sm_') {
        return parse_file_url($type . $this->model->getImage());
    }
}