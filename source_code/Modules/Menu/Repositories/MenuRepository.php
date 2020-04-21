<?php

namespace Modules\Menu\Repositories;

interface MenuRepository {

    /**
     * Get all menu
     * @param  array   $filter
     * @param  array   $sort
     * @param  boolean $sortable
     * @return \Illuminate\Support\Collection
     */
    public function get(array $filter = array(), array $sort = array(), $sortable = true);
}