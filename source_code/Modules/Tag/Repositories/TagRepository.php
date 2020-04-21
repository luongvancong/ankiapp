<?php

namespace Modules\Tag\Repositories;

interface TagRepository {

    /**
     * Get tags
     * @param  integer  $perPage
     * @param  array   $with
     * @param  array   $filter
     * @param  array   $sort
     * @param  boolean $paginate
     * @return mixed
     */
    public function get($perPage = 20, array $with = array(), array $filter = array(), array $sort = array(), $paginate = true);

    /**
     * Get one tag by name
     * @param  string $name
     * @return \Modules\Tag\Repositories\Tag | null
     */
    public function getByName($name);
}