<?php

namespace Modules\Page\Providers;

use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
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
        $this->app->bind('Modules\Page\Repositories\PageRepository', 'Modules\Page\Repositories\DbPageRepository');
    }


    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/page');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/page';
        }, \Config::get('view.paths')), [$sourcePath]), 'page');
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
