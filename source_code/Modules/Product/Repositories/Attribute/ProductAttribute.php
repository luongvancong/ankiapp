<?php

namespace Modules\Product\Repositories\Attribute;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model {

    protected $table = 'product_attributes';

    public $timestamps = false;

    protected $guarded = ['id', '_token'];

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Một thuộc tính có nhiều giá trị
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function values()
    {
        return $this->hasMany('Modules\Product\Repositories\Attribute\ProductAttributeValue', 'attribute_id');
    }
}