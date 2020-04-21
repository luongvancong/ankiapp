<?php

namespace Modules\Product\Repositories\Category;

use Modules\Category\Repositories\Category as BaseCategory;

class ProductCategory extends BaseCategory {

    public function products()
    {
        return $this->hasMany('Modules\Product\Repositories\Product', 'category_id');
    }

    public function presenter()
    {
        return new Presenter($this);
    }


    /**
     * Một danh mục có nhiều thuộc tính
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function attributes()
    {
        return $this->hasMany('Modules\Product\Repositories\Attribute\ProductAttribute', 'category_id');
    }
}