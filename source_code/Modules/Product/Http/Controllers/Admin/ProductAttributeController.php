<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Product\Http\Requests\AdminProductAttributeFormRequest;
use Modules\Product\Repositories\Attribute\ProductAttributeRepository;
use Modules\Product\Repositories\Category\ProductCategoryRepository;
use App\Http\Controllers\Admin\AdminController;

class ProductAttributeController extends AdminController {

    public function __construct(ProductCategoryRepository $category, ProductAttributeRepository $attribute)
    {
        parent::__construct();
        $this->category = $category;
        $this->attribute = $attribute;
    }

    public function getIndex($categoryId, Request $request)
    {
        $category = $this->category->getById($categoryId);
        $attributes = $this->attribute->getByCategoryId($categoryId, 30, $request->all());
        return view('product::admin/attribute/index', compact('category', 'attributes'));
    }

    public function getCreate($categoryId)
    {
        $category = $this->category->getById($categoryId);
        $attribute = $this->attribute->getInstance();
        return view('product::admin/attribute/create', compact('category', 'attribute'));
    }

    public function postCreate($categoryId, AdminProductAttributeFormRequest $request)
    {
        $data = $request->all();
        $data['name_hash'] = md5($data['name']);
        $data['category_id'] = $categoryId;

        if($attribute = $this->attribute->create($data)) {
            return redirect()->route('admin.product_attribute.index', $categoryId)->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.product_attribute.index', $categoryId)->with('error', trans('general.messages.update_fail'));
    }

    public function getEdit($categoryId, $attrId)
    {
        $category = $this->category->getById($categoryId);
        $attribute = $this->attribute->getById($attrId);
        return view('product::admin/attribute/create', compact('category', 'attribute'));
    }

    public function postEdit($categoryId, $attrId, AdminProductAttributeFormRequest $request)
    {
        $data = $request->except(['_token']);
        $data['name_hash'] = md5($data['name']);
        $data['category_id'] = $categoryId;

        if($this->attribute->update($data, ['id' => $attrId]) >= 0) {
            return redirect()->route('admin.product_attribute.index', $categoryId)->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.product_attribute.index', $categoryId)->with('error', trans('general.messages.update_fail'));
    }

    public function getDelete($categoryId, $attrId)
    {
        $category = $this->category->getById($categoryId);
        $attribute = $this->attribute->getById($attrId);

        if($this->attribute->delete($attrId)) {
            return redirect()->route('admin.product_attribute.index', $categoryId)->with('success', trans('general.messages.delete_success'));
        }

        return redirect()->route('admin.product_attribute.index', $categoryId)->with('error', trans('general.messages.delete_fail'));
    }
}