<?php

namespace Modules\Menu\Repositories;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    const TYPE_CUSTOM        = 0;
    const TYPE_POST          = 1;
    const TYPE_POST_CATEGORY = 2;
    const TYPE_PAGE          = 3;

    protected $guarded = ['id'];

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function getObjectId()
    {
        return $this->object_id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getActive()
    {
        return $this->active;
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

    /**
     * Get menu type
     * @return array
     */
    public static function getTypeOptions()
    {
        return [
            self::TYPE_CUSTOM        => 'Tùy chỉnh',
            self::TYPE_POST          => 'Tin tức',
            self::TYPE_POST_CATEGORY => 'Danh mục tin tức',
            self::TYPE_PAGE          => 'Trang tĩnh'
        ];
    }
}