<?php

namespace Modules\Product\Repositories\Image;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model {

    protected $table = 'product_images';

    public $timestamps = false;

    protected $guarded = ['id', '_token'];

    public function getId()
    {
        return $this->id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getImageAlt()
    {
        return $this->image_alt;
    }

    public function presenter()
    {
        return new Presenter($this);
    }
}