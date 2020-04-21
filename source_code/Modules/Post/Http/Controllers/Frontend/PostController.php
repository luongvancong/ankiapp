<?php

namespace Modules\Post\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Modules\Post\Repositories\PostRepository;
use App\Http\Controllers\FrontendController;

class PostController extends FrontendController
{
    public function __construct(PostRepository $post, PostCategoryRepository $postCategory)
    {
        parent::__construct();
        $this->post = $post;
        $this->postCategory = $postCategory;
    }

    public function getIndex(Request $request)
    {
        return view('post::frontend/index');
    }

    public function getDetail($id, $slug)
    {
        return view('post::frontend/detail');
    }
}