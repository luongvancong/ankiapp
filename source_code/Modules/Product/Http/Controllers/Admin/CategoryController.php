<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Product\Http\Requests\AdminProductCategoryFormRequest;
use Modules\Product\Repositories\Category\ProductCategoryRepository;
use App\Http\Controllers\Admin\AdminController;

class CategoryController extends AdminController {

    public function __construct(ProductCategoryRepository $category)
    {
        parent::__construct();
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(Request $request)
    {
        $categories = $this->category->getAllCategories($request->all(), [], []);
        return view('product::admin/category/index', compact('categories'));
    }


    public function getCreate() {
        $category = $this->category->getInstance();
        $categories = $this->category->getAllCategories();
        return view('product::admin/category/create', compact('category', 'categories'));
    }

    public function postCreate(AdminProductCategoryFormRequest $request) {
        $data = $request->except('_token');

        if( $this->category->create($data) ) {
            return redirect()->route('admin.product_category.index')->with('success', trans('general.messages.create_success'));
        }

        return redirect()->back()->with('error', trans('general.messages.create_fail'));
    }

    public function getEdit($id) {
        $category = $this->category->getById($id);
        $categories = $this->category->getAllCategories();
        return view('product::admin/category/edit', compact('category', 'categories'));
    }

    public function postEdit($id, AdminProductCategoryFormRequest $request) {
        $id = (int) $id;
        $category = $this->category->getById($id);
        $categories = $this->category->getAllCategories();
        $data = $request->except('_token');

        try {
            if( $this->category->safeUpdate($data, $id, $categories) ) {
                return redirect()->route('admin.product_category.index')->with('success', trans('general.messages.update_success'));
            }
        }
        catch (\Modules\Category\Exceptions\CategoryCanNotBeParentItSelftException $e) {
            return redirect()->route('admin.product_category.index')->with('error', $e->getMessage());
        }
        catch (\Modules\Category\Exceptions\SafeUpdateException $e) {
            return redirect()->route('admin.product_category.index')->with('error', $e->getMessage());
        }

        return redirect()->route('admin.product_category.index')->with('error', trans('general.messages.update_fail'));
    }

    public function getDelete($id) {
        if($this->category->delete($id)) {
            return redirect()->route('admin.product_category.index')->with('success', trans('general.messages.delete_success'));
        }

        return redirect()->route('admin.product_category.index')->with('success', trans('general.messages.delete_fail'));
    }


    public function getOptimize()
    {
        $this->category->optimizeCategories();
        return redirect()->route('admin.product_category.index')->with('success', trans('general.messages.update_success'));
    }
}