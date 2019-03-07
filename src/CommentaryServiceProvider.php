<?php

namespace CreativityKills\Commentary;

use Illuminate\Support\ServiceProvider;

class CommentaryServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'creativitykills');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/commentary.php', 'commentary');

        // Register the service the package provides.
        $this->app->singleton('commentary', function ($app) {
            return new Commentary;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['commentary'];
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
            __DIR__.'/../config/commentary.php' => config_path('commentary.php'),
        ], 'commentary.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/creativitykills'),
        ], 'commentary.views');

        // Publishing public assets.
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/creativitykills'),
        ], 'commentary.views');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }
}
