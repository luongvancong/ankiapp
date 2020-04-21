<?php

namespace Modules\Qa\Providers;

use Illuminate\Support\ServiceProvider;

class QaServiceProvider extends ServiceProvider
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
        $this->app->singleton('Modules\Qa\Repositories\QuestionRepository', 'Modules\Qa\Repositories\DbQuestionRepository');
        $this->app->singleton('Modules\Qa\Repositories\AnswerRepository', 'Modules\Qa\Repositories\DbAnswerRepository');
    }


    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/qa');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/qa';
        }, \Config::get('view.paths')), [$sourcePath]), 'qa');
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
