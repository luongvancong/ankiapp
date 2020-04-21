<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Product\Http\Requests\AdminProductAttributeFormRequest;
use Modules\Product\Http\Requests\AdminProductAttributeValueFormRequest;
use Modules\Product\Repositories\Attribute\ProductAttributeRepository;
use Modules\Product\Repositories\Attribute\ProductAttributeValueRepository;
use Modules\Product\Repositories\Category\ProductCategoryRepository;
use App\Http\Controllers\Admin\AdminController;

class ProductAttributeValueController extends AdminController {

    public function __construct(ProductCategoryRepository $category, ProductAttributeRepository $attribute, ProductAttributeValueRepository $value)
    {
        parent::__construct();
        $this->category = $category;
        $this->attribute = $attribute;
        $this->value = $value;
    }

    public function getIndex($attrId, Request $request)
    {
        $attribute = $this->attribute->getById($attrId);
        $category = $this->category->getById($attribute->getCategoryId());
        return view('product::admin/attribute/value/index', compact('category', 'attribute'));
    }

    public function getCreate($attrId)
    {
        $attribute = $this->attribute->getById($attrId);
        $category = $this->category->getById($attribute->getCategoryId());
        $value = $this->value->getInstance();
        return view('product::admin/attribute/value/create', compact('category', 'attribute', 'value'));
    }

    public function postCreate($attrId, AdminProductAttributeValueFormRequest $request)
    {
        $attribute = $this->attribute->getById($attrId);
        $category = $this->category->getById($attribute->getCategoryId());

        $data = $request->all();
        $data['attribute_id'] = $attrId;

        if($value = $this->value->create($data)) {
            return redirect()->route('admin.product_attribute.values.index', $attrId)->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.product_attribute.values.index', $attrId)->with('error', trans('general.messages.update_fail'));
    }

    public function getEdit($attrId, $valueId)
    {
        $attribute = $this->attribute->getById($attrId);
        $category = $this->category->getById($attribute->getCategoryId());
        $value = $this->value->getById($valueId);
        return view('product::admin/attribute/value/edit', compact('category', 'attribute', 'value'));
    }

    public function postEdit($attrId, $valueId, AdminProductAttributeValueFormRequest $request)
    {
        $attribute = $this->attribute->getById($attrId);
        $category = $this->category->getById($attribute->getCategoryId());

        $data = $request->except('_token');
        $data['attribute_id'] = $attrId;

        if($this->value->update($data, ['id' => $valueId]) >= 0) {
            return redirect()->route('admin.product_attribute.values.index', $attrId)->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.product_attribute.values.index', $attrId)->with('error', trans('general.messages.update_fail'));
    }

    public function getDelete($attrId, $valueId)
    {
        $attribute = $this->attribute->getById($attrId);
        $value = $this->value->getById($valueId);

        if($this->value->delete($valueId)) {
            return redirect()->route('admin.product_attribute.values.index', $attrId)->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.product_attribute.values.index', $attrId)->with('error', trans('general.messages.update_fail'));
    }
}