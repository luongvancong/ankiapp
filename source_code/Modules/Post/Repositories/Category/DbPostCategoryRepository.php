<?php

namespace Modules\Post\Repositories\Category;

use Modules\Category\Repositories\Category;
use Modules\Category\Repositories\DbCategoryRepository;

class DbPostCategoryRepository extends DbCategoryRepository implements PostCategoryRepository {

    public function __construct(PostCategory $model)
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
        $defaultFilter = ['type' => Category::TYPE_POST];
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
        $data['type'] = Category::TYPE_POST;
        return parent::create($data);
    }
}