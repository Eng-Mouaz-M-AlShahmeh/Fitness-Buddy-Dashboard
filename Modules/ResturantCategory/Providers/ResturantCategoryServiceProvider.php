<?php

namespace Modules\ResturantCategory\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class ResturantCategoryServiceProvider extends ServiceProvider
{
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
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('ResturantCategory', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('ResturantCategory', 'Config/config.php') => config_path('resturantcategory.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('ResturantCategory', 'Config/config.php'), 'resturantcategory'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/resturantcategory');

        $sourcePath = module_path('ResturantCategory', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/resturantcategory';
        }, \Config::get('view.paths')), [$sourcePath]), 'resturantcategory');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/resturantcategory');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'resturantcategory');
        } else {
            $this->loadTranslationsFrom(module_path('ResturantCategory', 'Resources/lang'), 'resturantcategory');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('ResturantCategory', 'Database/factories'));
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
