<?php

namespace Modules\User\Repositories\Chmod;

use Modules\User\Repositories\Chmod\Permission;
use App\Hocs\Core\BaseRepository;

/**
 * Class description.
 *
 * @author	AlvinTran
 */
class DbPermissionRepository extends BaseRepository implements PermissionRepository
{
	protected $model;

	public function __construct(Permission $model)
	{
		$this->model = $model;
	}

    public function getAllWithPaginate($filter = [], $pageSize = 20)
    {
        $query = $this->model->whereRaw(1);

        if ( ! empty($filter))
        {
            foreach ($filter as $key => $value)
            {
                if ($value == '')
                {
                    unset($filter[$key]);
                }
            }

            $query->where($filter);
        }

        return $query->orderBy('name', 'ASC')->paginate($pageSize);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    public function getByName($name)
    {
        return $this->model->where('name', $name)->first();
    }

    public function deleteByName($name)
    {
        return $this->model->where('name', $name)->delete();
    }
}