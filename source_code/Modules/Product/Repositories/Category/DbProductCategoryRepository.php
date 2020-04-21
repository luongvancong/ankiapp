<?php

namespace Modules\Product\Repositories\Category;

use Modules\Category\Repositories\Category;
use Modules\Category\Repositories\DbCategoryRepository;

class DbProductCategoryRepository extends DbCategoryRepository implements ProductCategoryRepository {

    public function __construct(ProductCategory $model)
    {
        $this->model = $model;
    }

    /**
     * Get all categories
     * Override parent
     * @param  array  $filter
     * @param  array  $sort
     * @param  array $with
     * @return \Illuminate\Support\Collection
     */
    public function getAllCategories($filter = array(), $sort = array(), array $with = array(), $sortable = true) {
        $defaultFilter = ['type' => Category::TYPE_PRODUCT];
        $filter = array_merge($defaultFilter, $filter);
        return parent::getAllCategories($filter, $sort, $with, $sortable);
    }

    /**
     * Create a new category
     * @override
     * @param  array  $data
     * @return \Modules\Post\Repositories\Category\PostCategory
     */
    public function create($data) {
        $data['type'] = Category::TYPE_PRODUCT;
        return parent::create($data);
    }
}