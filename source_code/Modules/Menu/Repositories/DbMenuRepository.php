<?php

namespace Modules\Menu\Repositories;

use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Repositories\CategoryTrait;
use Modules\Category\Repositories\DbCategoryRepository;
use App\Hocs\Core\BaseRepository;

class DbMenuRepository extends DbCategoryRepository implements MenuRepository {

    use CategoryTrait;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    public function get(array $filter = array(), array $sort = array(), $sortable = true)
    {
        // Sort
        $defaultSort = empty($sort) ? ['created_at' => 'ASC'] : array();
        $sort = array_merge($defaultSort, $sort);

        $data = $this->model->whereRaw(1);

        $name = array_get($filter, 'name');
        $active = array_get($filter, 'active', 'all');
        $type = array_get($filter, 'type');
        $parentId = array_get($filter, 'parent_id');

        if($active != 'all') {
            $data->where('active', $active);
        }

        if($name) {
            $data->where('name', 'LIKE', '%' . clean($name) . '%');
        }

        if(!is_null($type)) {
            $type = (array) $type;
            $data->whereIn('type', $type);
        }

        if(!is_null($parentId)) {
            $data->where('parent_id', $parentId);
        }

        foreach($sort as $k => $v) {
            $data->orderBy($k, $v);
        }

        $_data = $data->get();

        // Sortable
        if($sortable === true) {
            $sortable = new \App\Hocs\Sortable\Sortable($_data);
            return $sortable->getData();
        }

        return $_data;
    }
}