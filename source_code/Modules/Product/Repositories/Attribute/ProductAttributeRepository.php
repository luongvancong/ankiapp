<?php

namespace Modules\Product\Repositories\Attribute;

interface ProductAttributeRepository {

    /**
     * Get attributes
     * @param  integer  $perPage
     * @param  array   $with
     * @param  array   $filter
     * @param  array   $sort
     * @param  boolean $paginate
     * @return mixed
     */
    public function get($perPage = 30, array $with = array(), array $filter = array(), array $sort = array(), $paginate = true);


    /**
     * Get by category id
     * @param  integer  $categoryId
     * @param  integer $perPage
     * @param  array   $filter
     * @param  array   $sort
     * @param  boolean $paginate
     * @return mixed
     */
    public function getByCategoryId($categoryId, $perPage = 30, array $filter = array(), array $sort = array(), $paginate = true);
}