<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminLaravelServiceProvider extends ServiceProvider
{
    public function __construct()
    {
        $this->base_folder = dirname(__FILE__);
    }

    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../../routes.php';
        }

        $this->initViews($this->base_folder);
        $this->initTranslations($this->base_folder);
        $this->initConfig($this->base_folder);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            $base_folder . '/app/config/init.php', 'admin'
        );
    }

    public function initViews($base_folder)
    {
        $this->loadViewsFrom($base_folder . '/resources/views', 'admin');
        $this->publishes([
            $base_folder . '/resources/views' => 
                base_path('resources/views/vendor/admin-laravel5.x'),
        ]);
    }

    public function initTranslations($base_folder)
    {
        $this->loadTranslationsFrom($base_folder . '/resources/lang', 'admin');
    }

    public function initConfig($base_folder)
    {
        $this->publishes([
            $base_folder . '/app/config/init.php' => 
                config_path('admin-laravel5.x/init.php'),
        ]);
    }
}