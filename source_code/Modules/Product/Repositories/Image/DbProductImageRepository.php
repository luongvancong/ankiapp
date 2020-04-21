<?php

namespace Modules\Product\Repositories\Image;

use App\Hocs\Core\BaseRepository;

class DbProductImageRepository extends BaseRepository implements ImageRepository {

    /**
     * Model
     * @var \Modules\Product\Repositories\Image\ProductImage
     */
    protected $model;

    public function __construct(ProductImage $model)
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