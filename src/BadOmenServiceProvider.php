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
        
    }
}
