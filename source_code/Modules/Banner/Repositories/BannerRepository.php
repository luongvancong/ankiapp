<?php

namespace Modules\Banner\Repositories;

interface BannerRepository {
	/**
	 * Get banners have paginated
	 * @param  int $perPage
	 * @param  array  $filter
	 * @param  array  $sort
	 * @return Illuminate\Contracts\Pagination\Paginator
	 */
	public function getBanners($perPage = 20, array $filter = array(), array $sort = array(), $paginate = true);
}