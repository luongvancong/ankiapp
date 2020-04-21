<?php

use Modules\Category\Repositories\Category;

if( !function_exists('getCategoriesHtmlSelectOption') ) {
    function getCategoriesHtmlSelectOption($categories, $selectedId = null, $args = array()) {
        $defaultArgs = [
            'id'    => 'category_id',
            'name'  => 'category_id',
            'class' => 'select-category-id form-control'
        ];

        $attrStr = mergeAttributes($defaultArgs, $args);

        $html = '<select '. makeAttributes($attrStr) .'>';
        $html .= '<option value="">Vui lòng chọn danh mục</option>';

        foreach($categories as $category) {
            $selected = '';
            $char = '';
            if($selectedId !== null &&  (int) $selectedId === (int) $category->getId()) {
                $selected = 'selected="selected"';
            }

            for($i = 1; $i < $category->level; $i ++) {
                $char .= '--';
            }

            $html .= '<option value="'. $category->getId() .'" '. $selected .'>'. $char . $category->getName() .'</option>';
        }

        $html .= '</select>';

        return $html;
    }
}


if( !function_exists('category_product_count') ) {
    function category_product_count(App\Hocs\Categories\Category $category) {
        return App::make('App\Hocs\Products\ProductRepository')->countProductsByCategory($category);
    }
}


if( !function_exists('categoryRepository') ) {
    function categoryRepository() {
        return App::make('App\Hocs\Categories\CategoryRepository');
    }
}


if( !function_exists('category_count_child_by_id') ) {
    function category_count_child_by_id($id, $categories) {
        $tempCountChilds = array();

        foreach($categories as $cat) {
            if($cat->parent_id == $id) {
                $tempCountChilds[] = $cat;
            }
        }

        return count($tempCountChilds);
    }
}


if( !function_exists('category_get_by_id_from_list') ) {
    function category_get_by_id_from_list($id, $categories) {
        foreach($categories as $cat) {
            if($id == $cat->getId()) {
                return $cat;
            }
        }
    }
}





if( ! function_exists('category_get_all_childs') ) {
    function category_get_all_childs($parentId, $categories) {
        return categoryRepository()->getChildRecursive()->keys()->toArray();
    }
}


if( ! function_exists('category_get_level_by_id') ) {
    function category_get_level_by_id($id, $categories) {
        foreach($categories as $category) {
            if($category->getId() == $id) {
                return $category->level;
            }
        }

        return 0;
    }
}


if( ! function_exists('category_get_root_parent_by_id') ) {
    function category_get_root_parent_by_id($id, $categories) {
        foreach($categories as $category) {
            if($category->getId() == $id) {
                if($category->getParentId() > 0) {
                    $id = category_get_root_parent_by_id($category->getParentId(), $categories);
                }
            }
        }

        return $id;
    }
}


if( ! function_exists('category_get_type_options') ) {
    function category_get_type_options() {
        return [
            Category::TYPE_POST    => 'Tin tức',
            Category::TYPE_PRODUCT => 'Sản phẩm',
            Category::TYPE_STATIC  => 'Trang tĩnh'
        ];
    }
}