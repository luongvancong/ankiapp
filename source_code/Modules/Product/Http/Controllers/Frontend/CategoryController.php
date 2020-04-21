<?php

namespace Modules\Product\Http\Controllers\Frontend;

use Modules\Product\Repositories\Category\ProductCategoryRepository;
use Modules\Product\Repositories\ProductRepository;
use App\Http\Controllers\FrontendController;

class CategoryController extends FrontendController {

    /**
     * @var \Modules\Product\Repositories\ProductRepository
     */
    protected $product;

    /**
     * @var \Modules\Product\Repositories\Category\ProductCategoryRepository
     */
    protected $productCategory;

    public function __construct(ProductRepository $product, ProductCategoryRepository $productCategory)
    {
        parent::__construct();
        $this->product = $product;
        $this->productCategory = $productCategory;
    }

    /**
     * Trang chi tiết 1 danh mục
     * @param  integer $id
     * @param  string $slug
     * @return string
     */
    public function getDetail($id, $slug)
    {
        # code...
    }
}