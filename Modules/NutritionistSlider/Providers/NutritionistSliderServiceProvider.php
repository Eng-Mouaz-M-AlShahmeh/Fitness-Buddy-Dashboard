<?php

namespace Modules\NutritionistSlider\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class NutritionistSliderServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('NutritionistSlider', 'Database/Migrations'));
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
            module_path('NutritionistSlider', 'Config/config.php') => config_path('nutritionistslider.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('NutritionistSlider', 'Config/config.php'), 'nutritionistslider'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/nutritionistslider');

        $sourcePath = module_path('NutritionistSlider', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/nutritionistslider';
        }, \Config::get('view.paths')), [$sourcePath]), 'nutritionistslider');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/nutritionistslider');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'nutritionistslider');
        } else {
            $this->loadTranslationsFrom(module_path('NutritionistSlider', 'Resources/lang'), 'nutritionistslider');
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
            app(Factory::class)->load(module_path('NutritionistSlider', 'Database/factories'));
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
