<?php

namespace Modules\TrainerVideo\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class TrainerVideoServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('TrainerVideo', 'Database/Migrations'));
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
            module_path('TrainerVideo', 'Config/config.php') => config_path('trainervideo.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('TrainerVideo', 'Config/config.php'), 'trainervideo'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/trainervideo');

        $sourcePath = module_path('TrainerVideo', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/trainervideo';
        }, \Config::get('view.paths')), [$sourcePath]), 'trainervideo');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/trainervideo');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'trainervideo');
        } else {
            $this->loadTranslationsFrom(module_path('TrainerVideo', 'Resources/lang'), 'trainervideo');
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
            app(Factory::class)->load(module_path('TrainerVideo', 'Database/factories'));
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
