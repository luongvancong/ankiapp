<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Menu\Http\Requests\AdminMenuFormRequest;
use Modules\Menu\Repositories\Menu;
use Modules\Menu\Repositories\MenuRepository;
use Modules\Page\Repositories\PageRepository;
use Modules\Post\Repositories\Category\PostCategoryRepository;
use Modules\Post\Repositories\PostRepository;
use App\Http\Controllers\Admin\AdminController;

class MenuController extends AdminController {

    public function __construct(MenuRepository $menu, PostRepository $post, PostCategoryRepository $postCategory, PageRepository $page)
    {
        parent::__construct();
        $this->menu         = $menu;
        $this->post         = $post;
        $this->postCategory = $postCategory;
        $this->page         = $page;
    }

    public function getIndex(Request $request)
    {
        $menus = $this->menu->get($request->all());
        return view('menu::admin/index', compact('menus'));
    }

    public function getCreate(Request $request)
    {
        $menu = $this->menu->getInstance();
        $type = (int) $request->get('type');
        $menus = $this->menu->get();
        $postCategories = $this->postCategory->getAllCategories();
        return view('menu::admin/create', compact('menu', 'type', 'menus', 'postCategories'));
    }

    public function postCreate(AdminMenuFormRequest $request)
    {
        $data = $this->parseData($request);

        if($menu = $this->menu->create($data)) {
            return redirect()->route('admin.menu.index')->with('success', 'Cập nhật thành công');
        }

        return redirect()->route('admin.menu.index')->with('error', 'Cập nhật không thành công');
    }


    public function getEdit($id, Request $request)
    {
        $type = (int) $request->get('type');
        $menu = $this->menu->getById($id);
        $menus = $this->menu->get();
        $postCategories = $this->postCategory->getAllCategories();
        return view('menu::admin/edit', compact('menu', 'menus', 'type', 'postCategories'));
    }


    public function postEdit($id, AdminMenuFormRequest $request)
    {
        $menu = $this->menu->getById($id);
        $data = $this->parseData($request);
        $menus = $this->menu->get();

        try {
            if($this->menu->safeUpdate($data, $id, $menus)) {
                return redirect()->route('admin.menu.index')->with('success', trans('general.messages.update_success'));
            }
        }
        catch (\Modules\Category\Exceptions\CategoryCanNotBeParentItSelftException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
        catch (\Modules\Category\Exceptions\SafeUpdateException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.menu.index')->with('error', trans('general.messages.update_fail'));
    }

    public function getDelete($id)
    {
        $menu = $this->menu->getById($id);
        if($menu->delete()) {
            return redirect()->route('admin.menu.index')->with('success', trans('general.messages.delete_success'));
        }

        return redirect()->route('admin.menu.index')->with('error', trans('general.messages.delete_fail'));
    }


    public function getActive($id)
    {
        $menu = $this->menu->getById($id);
        $menu->active = !$menu->active;
        $menu->save();

        return response()->json([
            'code' => 1,
            'status' => $menu->active
        ]);
    }


    public function parseData(Request $request)
    {
        $type = (int) $request->get('type');
        $objectId = (int) $request->get('object_id');

        $data = [
            'label'     => clean($request->get('label')),
            'url'       => clean($request->get('url')),
            'type'      => $type,
            'object_id' => $objectId,
            'parent_id' => (int) $request->get('parent_id')
        ];

        switch ($type) {
            case Menu::TYPE_POST:
                $post = $this->post->getById($objectId);
                $data['url'] = $post->presenter()->getUrl();
                break;

            case Menu::TYPE_POST_CATEGORY:
                $postCategory = $this->postCategory->getById($objectId);
                $data['url'] = $postCategory->presenter()->getUrl();
                break;

            case Menu::TYPE_PAGE:
                $page = $this->page->getById($objectId);
                $data['url'] = $page->presenter()->getUrl();
                break;

            default:
                # code...
                break;
        }

        return $data;
    }


    public function getDesign(Request $request)
    {
        $menus = $this->menu->get([], ['sort' => 'DESC']);
        return view('menu::admin/design', compact('menus'));
    }

    public function postDesign(Request $request)
    {
        $data = $request->get('menu_item');
        parse_str($data, $parsedData);

        $sort = 10001;
        foreach($parsedData['menu_item'] as $id => $parentId) {
            $sort --;
            // Update parent id for menu
            Menu::where('id', $id)->update(['parent_id' => (int) $parentId, 'sort' => $sort]);
        }

        return response()->json(['code' => 1]);
    }


    public function ajaxSearchPost(Request $request, PostRepository $postRepository)
    {
        $posts = $postRepository->getPosts(20, ['title' => $request->get('q')]);
        $json = [];
        foreach($posts as $item) {
            $json[] = [
                'id' => $item->getId(),
                'name' => $item->getTitle()
            ];
        }

        return response()->json($json);
    }

    public function ajaxSearchPostCategory(Request $request)
    {
        $items = $this->postCategory->getAllCategories(['name' => $request->get('q')], [], [], false);
        $json = [];
        foreach($items as $item) {
            $json[] = [
                'id' => $item->getId(),
                'name' => $item->getName()
            ];
        }

        return response()->json($json);
    }

    public function ajaxSearchPage(Request $request)
    {
        $items = $this->page->getPages(20, ['title' => $request->get('q')], [], false);
        $json = [];
        foreach($items as $item) {
            $json[] = [
                'id' => $item->getId(),
                'name' => $item->getTitle()
            ];
        }

        return response()->json($json);
    }


    public function ajaxEditable(Request $request)
    {
        $id    = $request->get('pk');
        $field = $request->get('name');
        $value = clean($request->get('value'));

        $item = $this->menu->getById($id);
        $item->$field = $value;

        if($item->save()) {
            return response()->json(['code' => 1]);
        }

        return response()->json(['code' => 0]);
    }


    /**
     * Optmize menu
     * @return void
     */
    public function doOptimize()
    {
        $menus = $this->menu->get();
        // Reset has_child to zero
        \DB::table('menus')->update(['has_child' => 0]);

        foreach($menus as $item) {
            $item->level = $item->level;
            if($item->getParentId() > 0) {
                \DB::table('menus')->where('id', $item->getParentId())
                                   ->update(['has_child' => 1]);
            }

            \DB::table('menus')->where('id', $item->getId())
                               ->update(['level' => $item->level]);
        }
    }


    public function getOptimize(Request $request)
    {
        $this->doOptimize();
        return redirect()->route('admin.menu.index')->with('success', trans('general.messages.update_success'));
    }
}