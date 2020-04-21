<?php

namespace Modules\Tag\Providers;

use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
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
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Modules\Tag\Repositories\TagRepository', 'Modules\Tag\Repositories\DbTagRepository');
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'tag'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/tag');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/tag';
        }, \Config::get('view.paths')), [$sourcePath]), 'tag');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/tag');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'tag');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'tag');
        }
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
