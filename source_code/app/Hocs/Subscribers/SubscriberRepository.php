<?php

namespace App\Hocs\Subscribers;

use App\Hocs\Core\BaseRepository;

class SubscriberRepository extends BaseRepository {
    protected $model;

    public function __construct(Subscriber $model)
    {
        $this->model = $model;
    }

    public function unique($email)
    {
        return $this->model->where('email', $email)->count() > 0 ? false : true;
    }

    public function getPaginated($perPage = 25, array $filter = array(), array $sort = array())
    {

        $query = $this->model->whereRaw(1);

        if(!$sort) $sort = ['updated_at' => "DESC"];

        foreach($sort as $key => $value) {
            $query->orderBy($key, $value);
        }

        return $query->paginate($perPage);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}