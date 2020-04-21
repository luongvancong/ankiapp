<?php

namespace Modules\Post\Repositories\Category;

use Modules\Category\Repositories\Category;

class PostCategory extends Category {

    /**
     * Has many posts
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function posts()
    {
        return $this->hasMany('Modules\Post\Repositories\Post', 'category_id');
    }

    public function presenter() {
        return new Presenter($this);
    }
}