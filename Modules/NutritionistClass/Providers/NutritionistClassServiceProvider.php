<?php

namespace Modules\NutritionistClass\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class NutritionistClassServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('NutritionistClass', 'Database/Migrations'));
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
            module_path('NutritionistClass', 'Config/config.php') => config_path('nutritionistclass.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('NutritionistClass', 'Config/config.php'), 'nutritionistclass'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/nutritionistclass');

        $sourcePath = module_path('NutritionistClass', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/nutritionistclass';
        }, \Config::get('view.paths')), [$sourcePath]), 'nutritionistclass');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/nutritionistclass');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'nutritionistclass');
        } else {
            $this->loadTranslationsFrom(module_path('NutritionistClass', 'Resources/lang'), 'nutritionistclass');
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
            app(Factory::class)->load(module_path('NutritionistClass', 'Database/factories'));
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
