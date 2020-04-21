<?php

namespace Modules\Post\Repositories;

use Illuminate\Http\Request;
use App\Hocs\Tags\Tag;
use Illuminate\Pagination\Paginator;

/**
 * Interface description.
 *
 * @author Justin
 */
interface PostRepository
{
	public function getAll();

	public function getById($id);


    /**
     * Get post and filter, sort
     * @param  integer $perPage
     * @param  array   $filterArray
     * @return Paginator
     */
	public function getPosts($perPage = 20, $filterArray = array(), array $sortArray = array());


    /**
     * Đếm tất cả bài post
     * @return int
     */
    public function countAllPosts();



    /*
     * Lấy tin tức theo id danh mục
     * @param  int $categoryId
     * @param  int $take
     * @return Collection
     */
    public function getPostByCategoryId($categoryId, $take = 10);


    /**
     * Attach tags from request
     * @param  Post    $post
     * @param  Request $request
     * @return void
     */
    public function attachTagsFromRequest(Post $post, Request $request);


    /**
     * Sync tags from request
     * @param  Post    $post
     * @param  Request $request
     * @return void
     */
    public function syncTagsFromRequest(Post $post, Request $request);
}