<?php

namespace Alish\ActiveableModel;

use Illuminate\Support\ServiceProvider;

class ActiveableModelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {
    }
}
