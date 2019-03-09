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
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'commentary');

        $this->app['router']->namespace('CreativityKills\\Commentary\\Controllers')
            ->middleware(['web'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });

        $this->registerEventListeners();

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
        $this->mergeConfigFrom(__DIR__.'/../config/commentary.php', 'commentary');
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

        // Publishing database migration.
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }

    /**
     * Register the packages event listeners.
     */
    protected function registerEventListeners()
    {
        $this->app['events']->listen(UserSubscribed::class, SendSubscriptionNotification::class);
        $this->app['events']->listen(UserUnsubscribed::class, SendUnsubscribeNotification::class);
    }
}
