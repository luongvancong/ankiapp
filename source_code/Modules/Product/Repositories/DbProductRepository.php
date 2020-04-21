<?php

namespace Modules\Product\Repositories;

use App\Hocs\Core\BaseRepository;

class DbProductRepository extends BaseRepository implements ProductRepository {

    /**
     * @var \Modules\Product\Repositories\Product
     */
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function get($perPage = 20, array $with = array(), array $filter = array(), array $sort = array(), $paginate = true) {
        $query = $this->model->with($with)->whereRaw(1);

        $id = (int) array_get($filter, 'id');
        $id_in = (array) array_get($filter, 'id_in');
        $id_not_in = (array) array_get($filter, 'id_not_in');
        $categoryId = (int) array_get($filter, 'category_id');
        $category_in = (array) array_get($filter, 'category_in');
        $category_not_in = (array) array_get($filter, 'category_not_in');
        $name = array_get($filter, 'name');
        $price_between = (array) array_get($filter, 'price_between');

        if($id) $query->where('id', $id);
        if($id_in) $query->whereIn('id', $id_in);
        if($id_not_in) $query->whereNotIn('id', $id_not_in);
        if($categoryId) $query->where('category_id', $categoryId);
        if($category_in) $query->whereIn('category_id', $category_id);
        if($category_not_in) $query->whereNotIn('category_id', $category_not_in);
        if($name) $query->where('name', 'LIKE', '%'. $name .'%');
        if($price_between) $query->whereBetween('price', $price_between);

        if(!$sort) $sort = ['updated_at' => 'DESC'];
        foreach($sort as $key => $value) {
            $query->orderBy($key, $value);
        }

        if($paginate) {
            return $query->paginate($perPage);
        }

        return $query->take($perPage)->get();
    }

    public function saveProductImages($product, array $images) {
        foreach($images as $image) {
            $product->images()->create([
                'product_id' => $product->getId(),
                'image'      => $image
            ]);
        }
    }


    public function deleteMultiByIds(array $ids) {
        return $this->model->whereIn('id', $ids)->delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}