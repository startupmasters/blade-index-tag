<?php

namespace Startupmasters\BladeIndexTag;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeIndexTagServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::directive('index', function () {
            if (config('app.env') != 'production') {
                return '<meta name="robots" content="noindex, nofollow" />';
            }

            return '<meta name="robots" content="index, follow" />';

        });

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/bladeindextag.php', 'bladeindextag');

        // Register the service the package provides.
        $this->app->singleton('bladeindextag', function ($app) {
            return new BladeIndexTag;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['bladeindextag'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/bladeindextag.php' => config_path('bladeindextag.php'),
        ], 'bladeindextag.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/alexievbgn'),
        ], 'bladeindextag.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/alexievbgn'),
        ], 'bladeindextag.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/alexievbgn'),
        ], 'bladeindextag.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
