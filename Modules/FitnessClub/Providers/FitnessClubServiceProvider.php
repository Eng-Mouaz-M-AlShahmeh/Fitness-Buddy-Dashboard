<?php

namespace Modules\FitnessClub\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class FitnessClubServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('FitnessClub', 'Database/Migrations'));
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
            module_path('FitnessClub', 'Config/config.php') => config_path('fitnessclub.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('FitnessClub', 'Config/config.php'), 'fitnessclub'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/fitnessclub');

        $sourcePath = module_path('FitnessClub', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/fitnessclub';
        }, \Config::get('view.paths')), [$sourcePath]), 'fitnessclub');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/fitnessclub');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'fitnessclub');
        } else {
            $this->loadTranslationsFrom(module_path('FitnessClub', 'Resources/lang'), 'fitnessclub');
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
            app(Factory::class)->load(module_path('FitnessClub', 'Database/factories'));
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
