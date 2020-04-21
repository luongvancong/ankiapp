<?php

namespace Modules\Post\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Hocs\Posts\PostRepository;
use App\Http\Controllers\FrontendController;

class PostDetailController extends FrontendController
{
    public function __construct(PostRepository $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    public function getDetail($id, $slug)
    {
        echo $id . '/' . $slug;
    }
}