<?php

namespace Modules\Product\Repositories\Attribute;

use App\Hocs\Core\BaseRepository;

class DbProductAttributeValueRepository extends BaseRepository implements ProductAttributeValueRepository {

    protected $model;

    public function __construct(ProductAttributeValue $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}