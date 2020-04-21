<?php

namespace Modules\Qa\Repositories;

use App\Hocs\Core\BaseRepository;

class DbAnswerRepository extends BaseRepository implements AnswerRepository {

    protected $model;

    public function __construct(Answer $model)
    {
        $this->model = $model;
    }

    public function get($perPage = 20, array $with = array(), array $filter = array(), array $sort = array() , $paginate = true) {
        $query = $this->model->with($with)->whereRaw(1);

        $questionId = (int) array_get($filter, 'question_id');
        $questionIdIn = (array) array_get($filter, 'question_id_in');
        $questionIdNotIn = (array) array_get($filter, 'question_id_not_in');

        if($questionId) {
            $query->where('question_id', $questionId);
        }

        if($questionIdIn) {
            $query->whereIn('question_id', $questionIdIn);
        }

        if($questionIdNotIn) {
            $query->whereNotIn('question_id', $questionIdNotIn);
        }

        if(!$sort) $sort = ['updated_at' => 'desc'];

        foreach($sort as $key => $value) {
            $query->orderBy($key, $value);
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
        return $this->model;
    }
}