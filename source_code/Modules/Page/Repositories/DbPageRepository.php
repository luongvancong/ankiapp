<?php

namespace Modules\Page\Repositories;

use App\Hocs\Core\BaseRepository;

class DbPageRepository extends BaseRepository implements PageRepository {

    protected $model;

    public function __construct(Page $model) {
		$this->model = $model;
	}

	public function getPages($perPage = 10, array $filter = array(), array $sort = array(), $paginate = true) {
		$query = $this->model->whereRaw(1);

		$title = clean(array_get($filter, 'title'));
		$id = (int) array_get($filter, 'id');
		$idIn = (array) array_get($filter, 'id_in');
		$idNotIn = (array) array_get($filter, 'id_not_in');
		if(!$sort) $sort = ['created_at' => 'DESC'];

		if($title) {
			$query->where('title', 'LIKE', '%'. $title .'%');
		}

		if($id) {
			$query->where('id', '=', $id);
		}

		if($idIn) {
			$query->whereIn('id', $idIn);
		}

		if($idNotIn) {
			$query->whereNotIn('id', $idNotIn);
		}

		foreach($sort as $key => $value) {
			$query->orderBy($key, $value);
		}

		if($paginate) {
			return $query->paginate($perPage);
		}

		return $query->take($perPage)->get();
	}

	public function getBySlug($slug)
	{
		return $this->model->where('slug', $slug)->first();
	}

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}