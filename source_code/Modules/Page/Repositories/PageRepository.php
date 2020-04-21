<?php

namespace Modules\Page\Repositories;

interface PageRepository {
	public function getPages($perPage = 10, array $filter = array(), array $sort = array(), $paginate = true);
    public function getBySlug($slug);
}