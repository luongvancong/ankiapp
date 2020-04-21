<?php

namespace Modules\Banner\Repositories;

use App\Hocs\Core\BaseRepository;

class DbBannerRepository extends BaseRepository implements BannerRepository {

    protected $model;

    public function __construct(Banner $model)
	{
		$this->model = $model;
	}

	public function getBanners($perPage = 20, array $filter = array(), array $sort = array(), $paginate = true) {
		$query = $this->model->whereRaw(1);

		$position = array_get($filter, 'position');
		$page = array_get($filter, '_page');

		if($position) $query->where('position', trim($position));
		if($page) $query->where('page', trim($page));

		if(!$sort) $sort = ['updated_at' => 'DESC'];
		foreach($sort as $key => $value) {
			$query->orderBy($key, $value);
		}

		return $query->paginate($perPage);
	}

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}