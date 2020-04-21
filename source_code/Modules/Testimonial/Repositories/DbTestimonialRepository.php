<?php

namespace Modules\Testimonial\Repositories;

use App\Hocs\Core\BaseRepository;

class DbTestimonialRepository extends BaseRepository implements TestimonialRepository {

    /**
     * @var \Modules\Testimonial\Repositories\Testimonial
     */
    protected $model;

    public function __construct(Testimonial $model)
    {
        $this->model = $model;
    }

    public function get($perPage = 20, array $filter = array(), array $sort = array(), $paginate = true) {
        $query = $this->model->whereRaw(1);

        if(!$sort) $sort = ['updated_at' => 'DESC'];

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