<?php

namespace Modules\Qa\Repositories;

interface QuestionRepository {

    /**
     * Get questions
     * @param  integer $perPage
     * @param  array   $filterArray
     * @param  array   $sort
     * @param  boolean $paginate
     * @return mixed
     */
    public function get($perPage = 20, array $with = array(), array $filterArray = array(), array $sort = array(), $paginate = true);
}