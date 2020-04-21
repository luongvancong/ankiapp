<?php

namespace Modules\Qa\Repositories;

use App\Hocs\Core\BaseRepository;

class DbQuestionRepository extends BaseRepository implements QuestionRepository {

    protected $model;

    public function __construct(Question $model)
    {
        $this->model = $model;
    }

    public function get($perPage = 20, array $with = array(), array $filterArray = array(), array $sort = array(), $paginate = true) {
        $query = $this->model->with($with)->whereRaw(1);

        if(!$sort) $sort = ['updated_at' => 'desc'];

        foreach($sort as $key => $value) {
            if($key == 'RAND()') {
                $query->orderByRaw($key, $value);
            } else {
                $query->orderBy($key, $value);
            }
        }

        if($paginate) {
            return $query->paginate($perPage);
        }

        return $query->take($perPage)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        $this->model;
    }
}