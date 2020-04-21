<?php

namespace Modules\Product\Repositories\Attribute;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model {

    protected $table = 'product_attribute_values';

    public $timestamps = false;

    protected $guarded = ['id', '_token'];

    public function getId()
    {
        return $this->id;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getAttributeId()
    {
        return $this->attribute_id;
    }
}