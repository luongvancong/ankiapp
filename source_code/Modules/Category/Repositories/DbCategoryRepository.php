<?php

namespace Modules\Category\Repositories;

use Illuminate\Database\DatabaseManager as DBM;
use Illuminate\Support\Collection;
use Modules\Category\Exceptions\CategoryCanNotBeParentItSelftException;
use Modules\Category\Exceptions\SafeUpdateException;
use Modules\Category\Repositories\CategoryTrait;
use App\Hocs\Core\BaseRepository;

class DbCategoryRepository extends BaseRepository implements CategoryRepository
{
	use CategoryTrait;

	protected $model;

	protected $childRecursive;

	public function __construct(Category $model, DBM $db) {
		$this->model    = $model;
		$this->db       = $db;
	}

	/**
	 * Lấy ra tất cả các danh mục có trạng thái được Active
	 * @param  boolean $list   default: false
	 * @param  array   $conditions[] Mảng điều kiện
	 * @return array
	 */
	public function getAllCategories($filter = array(), $sort = array(), array $with = array(), $sortable = true)
	{
		// Sort
		$defaultSort = empty($sort) ? ['created_at' => 'ASC'] : array();
		$sort = array_merge($defaultSort, $sort);

		$data = $this->model->whereRaw(1);

		// With relationship
		foreach($with as $relation) {
			$data->with($relation);
		}

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

	/**
     * Get categories which sorted
     * @param  array  $filter
     * @param  array  $sort
     * @param  array  $with
     * @return \Illuminate\Support\Collection
     */
	public function getSortedCategories($filter = array(), $sort = array(), array $with = array()) {
		return $this->getAllCategories($filter, $sort, $with, true);
	}


	/**
	 * Lấy ra danh mục theo slug
	 * @param  [type] $slug [description]
	 * @return [type]       [description]
	 */
	public function getCategoryBySlug($slug, $exception = true) {
		$category = $this->model->where('slug', $slug)->where('active', Category::ACTIVE)->first();
		if(!$category && $exception) {
			throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Category not found");
		}

		return $category;
	}

	/**
	 * Toggle active status
	 *
	 * @param  Categories $categories
	 *
	 * @return Categories
	 */

	public function toggleActiveStatus(Category $category) {
		$category->active = !$category->active;
		return $category->save();
	}

	public function getChildsById($id, $take = 20) {
		return $this->model->where('parent_id', $id)
							->orderBy('updated_at', 'DESC')
							->take($take)
							->get();
	}


	/**
     * Optimize categories
     * @return void
     */
    public function optimizeCategories()
    {
        $categories = $this->getAllCategories();
        foreach($categories as $item) {
            $item->level = $item->level;
            if($item->getParentId() > 0) {
                $this->getModel()
                     ->where('id', $item->getParentId())
                     ->update(['has_child' => 1]);
            }

            $this->getModel()
                 ->where('id', $item->getId())
                 ->update(['level' => $item->level]);
        }
    }


	public function create($data)
	{
		$model = parent::create($data);

		$this->optimizeCategories();

		return $model;
	}


	public function update($data, $cond = array())
	{
		$result = parent::update($data, $cond);

		$this->optimizeCategories();

		return $result;
	}


	public function delete($id)
	{
		$result = parent::delete($id);

		$this->optimizeCategories();

		return $result;
	}

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}