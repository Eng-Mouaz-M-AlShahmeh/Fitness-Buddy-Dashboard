<?php

namespace Modules\TrainerSlider\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class TrainerSliderServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('TrainerSlider', 'Database/Migrations'));
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
            module_path('TrainerSlider', 'Config/config.php') => config_path('trainerslider.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('TrainerSlider', 'Config/config.php'), 'trainerslider'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/trainerslider');

        $sourcePath = module_path('TrainerSlider', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/trainerslider';
        }, \Config::get('view.paths')), [$sourcePath]), 'trainerslider');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/trainerslider');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'trainerslider');
        } else {
            $this->loadTranslationsFrom(module_path('TrainerSlider', 'Resources/lang'), 'trainerslider');
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
            app(Factory::class)->load(module_path('TrainerSlider', 'Database/factories'));
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
