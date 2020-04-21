<?php

namespace Modules\Post\Http\Controllers\Admin;

use App, Config;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Modules\Post\Http\Requests\AdminPostFormRequest;
use Modules\Post\Repositories\Category\PostCategoryRepository;
use Modules\Post\Repositories\DbPostRepository;
use Modules\Post\Repositories\PostRepository;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests;

class PostController extends AdminController
{
    protected $post;
    protected $category;
    protected $configThumbs;
    protected $image;

    public function __construct(PostRepository $post, PostCategoryRepository $category)
    {
        parent::__construct();
        $this->post = $post;
        $this->category = $category;
        $configImage = Config::get('image');
        $this->configThumbs = $configImage['array_resize_image'];
        $this->image = App::make('ImageFactory');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function getIndex(Request $request)
    {
        $posts = $this->post->getPosts(25, $request->all(), get_sort_params($request->all()));
        $categories = $this->category->getAllCategories();

        return view('post::admin/index', compact('posts', 'categories'));
    }


    /**
     * Create post form
     * @param  AdminPostFormRequest $request [description]
     * @return [type]                        [description]
     */
    public function getCreate()
    {
        $post = $this->post->getInstance();
        $categories = $this->category->getAllCategories();
        return view('post::admin/create', compact('post', 'categories'));
    }


    /**
     * Do create post
     * @param  AdminPostFormRequest $request [description]
     * @return [type]                        [description]
     */
    public function postCreate(AdminPostFormRequest $request)
    {
        $data = $request->except(['_token', 'tag']);
        $data = $this->uploadImage($request, $data);
        $data['user_id'] = $this->auth->getUser()->getId();
        if(!$data['slug']) $data['slug'] = removeTitle($data['title']);
        if( $post = $this->post->create($data) ) {
            $this->post->attachTagsFromRequest($post, $request);
            return redirect()->route('admin.post.create')->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.post.index')->with('error', trans('general.messages.update_fail'));
    }

    public function getEdit($postId) {
        $categories = $this->category->getAllCategories();
        $post = $this->post->getById($postId);
        return view('post::admin/edit', compact('post', 'categories'));
    }

    public function postEdit($postId, AdminPostFormRequest $request) {
        $post = $this->post->getById($postId);
        $data = $request->except('_token', 'tag');
        if(!$data['slug']) $data['slug'] = removeTitle($data['title']);
        $data = $this->uploadImage($request, $data);

        if( $this->post->update($data, ['id' => $postId]) ) {
            $this->post->syncTagsFromRequest($post, $request);
            return redirect()->route('admin.post.index')->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.post.index')->with('error', trans('general.messages.update_fail'));
    }

    public function getDelete($postId) {
        $post = $this->post->getById($postId);

        if($post->delete()) {
            return redirect()->back()->with('success', trans('general.messages.delete_success'));
        }

        return redirect()->back()->with('error', trans('general.messages.delete_fail'));
    }


    public function tagIndex($postId)
    {
        $post = $this->post->getById($postId);
        $tags = $post->tags()->get();

        return view('post::admin/tag/index', compact('post', 'tags'));
    }


    public function tagCreate($postId)
    {
        $post = $this->post->getById($postId);
        return view('post::admin/tag/create', compact('post'));
    }


    public function tagCreateStore($postId, Request $request)
    {
        $post = $this->post->getById($postId);
        $tags = explode(',', $request->get('tags'));
        $post->tags()->attach($tags);
        return redirect()->back()->with('success', 'Thêm tag thành công');
    }


    public function tagDelete($postId, $tagId)
    {
        \DB::table('posts_tags')->where('post_id', $postId)->where('tag_id', $tagId)->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }


    /**
     * Append data image file name
     * @param  [type] $request [description]
     * @param  [type] $data    [description]
     * @return [type]          [description]
     */
    public function uploadImage($request, $data)
    {
        if($request->hasFile('image')) {
            $resultUpload = $this->image->upload('image', $this->configThumbs, 'resize');
            if($resultUpload['status'] > 0) {
                $data['image'] = $resultUpload['filename'];
            }
        }

        return $data;
    }

    public function getActive($id)
    {
        $post = $this->post->getById($id);
        $post->active = !$post->active;
        $post->save();

        return response()->json([
            'status' => $post->active,
            'code'   => 1
        ]);
    }


    public function ajaxEditable(Request $request)
    {
        $id    = $request->get('pk');
        $field = $request->get('name');
        $value = clean($request->get('value'));

        $item = $this->post->getById($id);
        $item->$field = $value;

        if($item->save()) {
            return response()->json(['code' => 1]);
        }

        return response()->json(['code' => 0]);
    }

}
