<?php

namespace Modules\TrainerLanguage\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class TrainerLanguageServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('TrainerLanguage', 'Database/Migrations'));
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
            module_path('TrainerLanguage', 'Config/config.php') => config_path('trainerlanguage.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('TrainerLanguage', 'Config/config.php'), 'trainerlanguage'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/trainerlanguage');

        $sourcePath = module_path('TrainerLanguage', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/trainerlanguage';
        }, \Config::get('view.paths')), [$sourcePath]), 'trainerlanguage');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/trainerlanguage');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'trainerlanguage');
        } else {
            $this->loadTranslationsFrom(module_path('TrainerLanguage', 'Resources/lang'), 'trainerlanguage');
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
            app(Factory::class)->load(module_path('TrainerLanguage', 'Database/factories'));
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
