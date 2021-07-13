<?php

namespace Modules\DepartmentPlan\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class DepartmentPlanServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('DepartmentPlan', 'Database/Migrations'));
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
            module_path('DepartmentPlan', 'Config/config.php') => config_path('departmentplan.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('DepartmentPlan', 'Config/config.php'), 'departmentplan'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/departmentplan');

        $sourcePath = module_path('DepartmentPlan', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/departmentplan';
        }, \Config::get('view.paths')), [$sourcePath]), 'departmentplan');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/departmentplan');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'departmentplan');
        } else {
            $this->loadTranslationsFrom(module_path('DepartmentPlan', 'Resources/lang'), 'departmentplan');
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
            app(Factory::class)->load(module_path('DepartmentPlan', 'Database/factories'));
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
