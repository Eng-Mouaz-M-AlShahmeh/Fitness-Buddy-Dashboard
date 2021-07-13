<?php

namespace Modules\DepartmentSlider\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class DepartmentSliderServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('DepartmentSlider', 'Database/Migrations'));
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
            module_path('DepartmentSlider', 'Config/config.php') => config_path('departmentslider.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('DepartmentSlider', 'Config/config.php'), 'departmentslider'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/departmentslider');

        $sourcePath = module_path('DepartmentSlider', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/departmentslider';
        }, \Config::get('view.paths')), [$sourcePath]), 'departmentslider');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/departmentslider');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'departmentslider');
        } else {
            $this->loadTranslationsFrom(module_path('DepartmentSlider', 'Resources/lang'), 'departmentslider');
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
            app(Factory::class)->load(module_path('DepartmentSlider', 'Database/factories'));
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
