<?php

namespace Modules\Category\Http\Controllers\Admin;

use App, Config;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Repositories\Category;
use Modules\Category\Repositories\CategoryRepository;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests;
use App\Http\Requests\AdminCategoryRequest;

class CategoryController extends AdminController
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->category = $category;
        $this->image = App::make("ImageFactory");

        $thumbs = Config::get('image');
        $this->thumbsConfig = $thumbs['array_resize_image'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $categories   = $this->category->getAllCategories($filter, $request->all());
        return view('category::admin/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->category->getAllCategories();
        $category = new Category();
        return view('category::admin/create', compact('categories', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AdminCategoryRequest $request)
    {
        $data = $request->except(['_token']);

        $data['parent_id'] = $data['category_id'];
        unset($data['category_id']);

        if(isset($data['slug'])) {
            if($data['slug']) {
                $data['slug'] = removeTitle($data['slug']);
            } else {
                $data['slug'] = removeTitle($data['name']);
            }
        }

        if($request->hasFile('background')) {
            $uploadResult = $this->image->upload('background', PATH_UPLOAD_IMAGE_CATEGORY, $this->thumbsConfig, 'resize');
            if($uploadResult['status'] > 0) {
                $data['background'] = $uploadResult['filename'];
            }
        }

        if($request->hasFile('background_homepage')) {
            $uploadResult = $this->image->upload('background_homepage', PATH_UPLOAD_IMAGE_CATEGORY, $this->thumbsConfig, 'resize');
            if($uploadResult['status'] > 0) {
                $data['background_homepage'] = $uploadResult['filename'];
            }
        }

        $category = $this->category->create($data);

        if ($category) {
            return redirect()->route('admin.category.edit', [$category->getId()])->with('success', trans('general.messages.update_success'));
        }

        return redirect()->back()->withInputs()->with('error', trans('general.messages.update_fail'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category   = $this->category->getById($id);
        $categories = $this->category->getAllCategories();

        return view('category::admin/edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id, AdminCategoryRequest $request)
    {
        $category = $this->category->getById($id);

        $data = $request->except(['_token']);

        $data['parent_id'] = $data['category_id'];
        unset($data['category_id']);

        if(isset($data['slug'])) {
            if($data['slug']) {
                $data['slug'] = removeTitle($data['slug']);
            } else {
                $data['slug'] = removeTitle($data['name']);
            }
        }

        if($request->hasFile('background')) {
            $uploadResult = $this->image->upload('background', PATH_UPLOAD_IMAGE_CATEGORY, $this->thumbsConfig, 'resize');

            if($uploadResult['status'] > 0) {
                $data['background'] = $uploadResult['filename'];
            }
        }

        if($request->hasFile('background_homepage')) {
            $uploadResult = $this->image->upload('background_homepage', PATH_UPLOAD_IMAGE_CATEGORY, $this->thumbsConfig, 'resize');
            if($uploadResult['status'] > 0) {
                $data['background_homepage'] = $uploadResult['filename'];
            }
        }

        if($this->category->update($data, ['id' => $id])) {
            return redirect()->route('admin.category.index')->with('success', 'Cập nhật thành công');
        }

        return redirect()->route('admin.category.index')->with('error', 'Cập nhật không thành công');
    }

    /**
     * Update the active category in storage
     * @param  int  $id
     * @return Response
     */

    public function active($id)
    {
        $category   = $this->category->getById($id);
        return $this->updater->toggleActiveStatus($this, $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->category->getById($id);

        $cloneCategory = clone $category;

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Xóa thành công danh mục ' . $cloneCategory->getName());
    }

    public function toggleActive($id)
    {
        $category = $this->category->getById($id);
        $category->active = !$category->active;
        $category->save();

        return response()->json([
            'status' => $category->active,
            'code' => 1
        ]);
    }


    /**
     * Cập nhật data ajax editable
     * @param  int  $id
     * @param  Request $request
     * @return json
     */
    public function ajaxEditAble(Request $request)
    {
        $id    = $request->get('pk');
        $field = $request->get('name');
        $value = clean($request->get('value'));

        $category = $this->category->getById($id);
        $category->$field = clean($value);

        if($category->save()) {
            return response()->json(['code' => 1]);
        }

        return response()->json(['code' => 0]);
    }
}
