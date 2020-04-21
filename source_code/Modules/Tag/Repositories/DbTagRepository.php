<?php

namespace Modules\Tag\Repositories;

use App\Hocs\Core\BaseRepository;

class DbTagRepository extends BaseRepository implements TagRepository {
    protected $model;

    /**
     * Tag
     * @param \Modules\Tag\Repositories\Tag $model
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function get($perPage = 20, array $with = array(), array $filter = array(), array $sort = array(), $paginate = true) {
        $query = $this->model->with($with)->whereRaw(1);

        $name = clean(array_get($filter, 'name'));

        if($name) {
            $query->where('name', 'LIKE', '%'. $name . '%');
        }

        if(!$sort) $sort = ['created_at' => 'DESC'];

        foreach($sort as $key => $value) {
            $query->orderBy($key, $value);
        }

        if($paginate) {
            return $query->paginate($perPage);
        }

        return $query->take($perPage)->get();
    }

    public function getByName($name) {
        return $this->model->where('name', $name)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}