<?php

namespace Nanuc\LaravelTokenable;

use Illuminate\Support\ServiceProvider;

class LaravelTokenableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {

    }
}