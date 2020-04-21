<?php

namespace Modules\Product\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Modules\Product\Repositories\ProductRepository', 'Modules\Product\Repositories\DbProductRepository');
        $this->app->singleton('Modules\Product\Repositories\Category\ProductCategoryRepository', 'Modules\Product\Repositories\Category\DbProductCategoryRepository');
        $this->app->singleton('Modules\Product\Repositories\Image\ImageRepository', 'Modules\Product\Repositories\Image\DbImageRepository');

        $this->app->singleton('Modules\Product\Repositories\Attribute\ProductAttributeRepository', 'Modules\Product\Repositories\Attribute\DbProductAttributeRepository');
        $this->app->singleton('Modules\Product\Repositories\Attribute\ProductAttributeValueRepository', 'Modules\Product\Repositories\Attribute\DbProductAttributeValueRepository');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/product');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/product';
        }, \Config::get('view.paths')), [$sourcePath]), 'product');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
