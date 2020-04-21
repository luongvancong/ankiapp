<?php

namespace App\Http\Controllers\Frontend\Post;

use Illuminate\Http\Request;
use App\Hocs\Posts\PostRepository;
use App\Http\Controllers\FrontendController;

class PostCategoryController extends FrontendController
{
    public function __construct(PostRepository $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    public function getIndex($categoryId, $slug, Request $request)
    {
        # code...
    }
}