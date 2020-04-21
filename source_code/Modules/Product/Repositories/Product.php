<?php

namespace Modules\Product\Repositories;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $table = 'products';

    protected $guarded = ['id', '_token'];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = (int) $value;
    }

    public function setPromotionPriceAttribute($value)
    {
        $this->attributes['promotion_price'] = (int) $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getImageAlt()
    {
        return $this->image_alt;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getSlug()
    {
        return $this->slug ? $this->slug : removeTitle($this->getName());
    }

    public function getPrice()
    {
        return (int) $this->price;
    }

    public function getPromotionPrice()
    {
        return (int) $this->promotion_price;
    }

    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    public function getMetaKeyword()
    {
        return $this->meta_keyword;
    }

    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    public function hasImage()
    {
        return $this->image ? true : false;
    }


    public function getContent()
    {
        return $this->content;
    }


    public function getShortDescription()
    {
        return $this->short_description;
    }


    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function presenter() {
        return new ProductPresenter($this);
    }


    public function category()
    {
        return $this->belongsTo('Modules\Product\Repositories\Category\ProductCategory', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('Modules\Tag\Repositories\Tag', 'products_tags');
    }

    public function images()
    {
        return $this->hasMany('Modules\Product\Repositories\Image\ProductImage', 'product_id');
    }

    /**
     * Một sản phẩm có nhiều giá trị thuộc tính
     * VD: Một sản phẩm có nhiều màu sắc: xanh, đỏ, tím vàng
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function attribute_values()
    {
        return $this->belongsToMany('Modules\Product\Repositories\Attribute\ProductAttributeValue', 'products_attribute_values', 'product_id');
    }
}