<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Product\Http\Requests\AdminProductFormRequest;
use Modules\Product\Repositories\Category\ProductCategoryRepository;
use Modules\Product\Repositories\ProductRepository;
use App\Http\Controllers\Admin\AdminController;
use App;

class ProductController extends AdminController {

    /**
     * Product
     * @var \Modules\Product\Repositories\ProductRepository
     */
    protected $product;

    public function __construct(ProductRepository $product, ProductCategoryRepository $category)
    {
        parent::__construct();
        $this->product = $product;
        $this->category = $category;
        $this->image = App::make('ImageFactory');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = $this->category->getAllCategories();
        $products = $this->product->get(20, ['category', 'images'], $request->all(), $this->getSortParams($request));
        return view('product::admin/index', compact('categories', 'products'));
    }


    /**
     * Create product
     * @return mixed
     */
    public function create()
    {
        $product = $this->product->getInstance();
        $categories = $this->category->getAllCategories();
        return view('product::admin/create', compact('product', 'categories'));
    }


    /**
     * Nhân bản sản phẩm
     * @param  integer $id
     * @return string
     */
    public function clone($id)
    {
        $product = $this->product->getById($id);
        $categories = $this->category->getAllCategories();
        return view('product::admin/create', compact('product', 'categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AdminProductFormRequest $request)
    {
        $data = $request->except(['_token', 'images', '_image', '_image_homepage']);
        // _debug($data);die;

        if ($product = $this->product->create($data))
        {
            $this->saveProductImages($product, $request);
            return redirect()->route('admin.product.index')->with('success', trans('general.messages.create_success'));
        }

        return redirect()->back()->withInputs()->with('error', trans('general.messages.create_fail'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->product->getById($id);
        $categories = $this->category->getAllCategories();
        return view('product::admin/edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id, AdminProductFormRequest $request)
    {
        $data = $request->except(['_token', 'images', '_image', '_image_homepage']);

        if ($this->product->update($data, ['id' => $id]))
        {
            $product = $this->product->getById($id);
            return redirect()->route('admin.product.index')->with('success', trans('general.messages.update_success'));
        }

        return redirect()->back()->withInputs()->with('error', trans('general.messages.update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->product->getById($id);

        if ($this->product->delete($id))
        {
            return redirect()->route('admin.product.index')->with('success', trans('general.messages.delete_success'));
        }

        return redirect()->route('admin.product.index')->with('error', trans('general.messages.delete_fail'));
    }


    public function saveProductImages($product, Request $request) {
        if($request->hasFile('images')) {
            $resultUpload = $this->image->uploadMulti('images');
            if($resultUpload['filename']) {
                $this->product->saveProductImages($product, $resultUpload['filename']);
            }
        }
    }


    /**
     * Xóa nhiều sản phẩm 1 lúc
     * @param  Request $request
     * @return json
     */
    public function ajaxQuickDeleteMultiple(Request $request)
    {
        $ids = $request->get('product_ids');

        if($this->product->deleteMultiByIds($ids)) {
            return response()->json(['code' => 1]);
        }

        return response()->json(['code' => 0]);
    }

    public function ajaxEditable(Request $request)
    {
        $id    = $request->get('pk');
        $field = $request->get('name');
        $value = $request->get('value');

        if(in_array($field, ['price', 'promotion_price'])) {
            $value = preg_replace('#\D#', '', $value);
        }

        return $this->product->update([$field => $value], ['id' => $id]);
    }

    /**
     * Toggle active status
     * @param  int $id
     * @return json
     */
    public function toggleActive($id)
    {
        $product = $this->product->getById($id);

        $product->active = ! $product->active;
        $product->save();

        return response()->json([
           'code' => 1,
           'status' => $product->active,
        ]);
    }

    /**
     * Build sort params
     * @param  Request $request
     * @return array
     */
    private function getSortParams(Request $request) {
        if($request->get('_action') == 'sort') {
            return [$request->get('sort_key') => $request->get('sort_value')];
        }

        return [];
    }
}