<?php

namespace Modules\NutritionistContact\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class NutritionistContactServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('NutritionistContact', 'Database/Migrations'));
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
            module_path('NutritionistContact', 'Config/config.php') => config_path('nutritionistcontact.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('NutritionistContact', 'Config/config.php'), 'nutritionistcontact'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/nutritionistcontact');

        $sourcePath = module_path('NutritionistContact', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/nutritionistcontact';
        }, \Config::get('view.paths')), [$sourcePath]), 'nutritionistcontact');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/nutritionistcontact');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'nutritionistcontact');
        } else {
            $this->loadTranslationsFrom(module_path('NutritionistContact', 'Resources/lang'), 'nutritionistcontact');
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
            app(Factory::class)->load(module_path('NutritionistContact', 'Database/factories'));
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
