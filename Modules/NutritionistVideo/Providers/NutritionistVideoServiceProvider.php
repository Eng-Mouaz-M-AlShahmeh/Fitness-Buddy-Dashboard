<?php

namespace Modules\NutritionistVideo\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class NutritionistVideoServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('NutritionistVideo', 'Database/Migrations'));
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
            module_path('NutritionistVideo', 'Config/config.php') => config_path('nutritionistvideo.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('NutritionistVideo', 'Config/config.php'), 'nutritionistvideo'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/nutritionistvideo');

        $sourcePath = module_path('NutritionistVideo', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/nutritionistvideo';
        }, \Config::get('view.paths')), [$sourcePath]), 'nutritionistvideo');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/nutritionistvideo');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'nutritionistvideo');
        } else {
            $this->loadTranslationsFrom(module_path('NutritionistVideo', 'Resources/lang'), 'nutritionistvideo');
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
            app(Factory::class)->load(module_path('NutritionistVideo', 'Database/factories'));
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
