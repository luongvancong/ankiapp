<?php

namespace Modules\Product\Repositories\Attribute;

use App\Hocs\Core\BaseRepository;

class DbProductAttributeRepository extends BaseRepository implements ProductAttributeRepository{

    /**
     * @var \Modules\Product\Repositories\Attribute\ProductAttribute
     */
    protected $model;

    public function __construct(ProductAttribute $model)
    {
        $this->model = $model;
    }


    public function get($perPage = 30, array $with = array(), array $filter = array(), array $sort = array(), $paginate = true) {
        $query = $this->model->with($with);

        $id = (int) array_get($filter, 'id');
        $name = clean(array_get($filter, 'name'));
        $categoryId = (int) array_get($filter, 'category_id');

        if($id) $query->where('id', $id);
        if($name) $query->where('name', 'LIKE', '%'.$name.'%');
        if($categoryId) $query->where('category_id', $categoryId);

        if(!$sort) $sort = ['name' => 'ASC'];
        foreach($sort as $key => $value) {
            $query->orderBy($key, $value);
        }

        return $paginate ? $query->paginate($perPage) : $query->take($perPage)->get();
    }


    public function getByCategoryId($categoryId, $perPage = 30, array $filter = array(), array $sort = array(), $paginate = true) {
        $filter['category_id'] = $categoryId;
        return $this->get($perPage, [], $filter, $sort, $paginate);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}