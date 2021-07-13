<?php

namespace Modules\ClubSubscription\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class ClubSubscriptionServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('ClubSubscription', 'Database/Migrations'));
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
            module_path('ClubSubscription', 'Config/config.php') => config_path('clubsubscription.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('ClubSubscription', 'Config/config.php'), 'clubsubscription'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/clubsubscription');

        $sourcePath = module_path('ClubSubscription', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/clubsubscription';
        }, \Config::get('view.paths')), [$sourcePath]), 'clubsubscription');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/clubsubscription');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'clubsubscription');
        } else {
            $this->loadTranslationsFrom(module_path('ClubSubscription', 'Resources/lang'), 'clubsubscription');
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
            app(Factory::class)->load(module_path('ClubSubscription', 'Database/factories'));
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
