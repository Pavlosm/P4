<?php

namespace Pav\DBManager;

use Illuminate\Support\ServiceProvider;

class DatabaseManagerServiceProvider extends ServiceProvider {


    public function register()
    {
        $this->app['DatabaseManager'] = $this->app->share(function($app)
        {
            return new DatabaseManager();
        });

        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('DatabaseManager', 'Pav\DBManager\Facades\DatabaseManager');
        });
    }
}