<?php

namespace Modules\Product\Repositories;

interface ProductRepository {

    /**
     * Get products
     * @param  integer $perPage
     * @param  array   $with
     * @param  array   $filter
     * @param  array   $sort
     * @param  boolean $paginate
     * @return mixed
     */
    public function get($perPage = 20, array $with = array(), array $filter = array(), array $sort = array(), $paginate = true);

    /**
     * Save product images
     * @return [type] [description]
     */
    public function saveProductImages($product, array $images);

    /**
     * Delete multi by id
     * @param  array  $ids
     * @return boolean
     */
    public function deleteMultiByIds(array $ids);
}