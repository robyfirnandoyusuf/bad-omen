<?php
namespace Robyfirnandoyusuf\BadOmen;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Robyfirnandoyusuf\BadOmen\Commands\Migrate;

class BadOmenServiceProvider extends ServiceProvider {

    // protected $commands = [
    //     Robyfirnandoyusuf\BadOmen\Migrate::class,
    // ];

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

    // public function boot(\Illuminate\Routing\Router $router) {
    //     $this->commands($this->commands);
    // }
}