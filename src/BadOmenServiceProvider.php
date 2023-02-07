<?php

namespace Robyfirnandoyusuf\BadOmen;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Robyfirnandoyusuf\BadOmen\Commands\Migrate;

class BadOmenServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Migrate::class
            ]);
        }
    }

    public function register()
    {
        $this->app->bind(
            'Robyfirnandoyusuf\BadOmen\Commands\Migrate',
        );

        $this->app->singleton(Migrate::class, function($app) {
            return new Migrate();
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                Robyfirnandoyusuf\BadOmen\Commands\Migrate::class
            ]);
        }
    }
}
