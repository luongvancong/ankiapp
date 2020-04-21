<?php

namespace Modules\Category\Repositories;

use Illuminate\Support\Collection;

interface CategoryRepository
{
    /**
     * Get by slug
     * @param  string $slug
     * @return \Modules\Category\Repositories\Category or null
     */
	public function getCategoryBySlug($slug);


    /**
     * Get childs
     * @param  Category $category [description]
     * @return [type]             [description]
     */
    public function getChildsById($id, $take = 20);


    /**
     * Safe update category
     * @param  array  $array
     * @param  integer $id
     * @param  \Illuminate\Support\Collection $categories
     * @return boolean
     */
    public function safeUpdate(array $data, $id, Collection $categories);


    /**
     * Lấy tất cả con, cháu, chắt, chút, chít của danh mục theo id
     * @param  integer $parentId
     * @param  \Illuminate\Support\Collection $categories
     * @return \Illuminate\Support\Collection
     */
    public function getChildRecursive($parentId, Collection $categories);


    /**
     * Get categories
     * @param  array  $filter
     * @param  array  $sort
     * @param  array  $with
     * @param  boolean $sortable
     * @return \Illuminate\Support\Collection
     */
    public function getAllCategories($filter = array(), $sort = array(), array $with = array(), $sortable = true);

    /**
     * Get categories which sorted
     * @param  array  $filter
     * @param  array  $sort
     * @param  array  $with
     * @return \Illuminate\Support\Collection
     */
    public function getSortedCategories($filter = array(), $sort = array(), array $with = array());


    /**
     * Optimize categories
     * @return void
     */
    public function optimizeCategories();
}