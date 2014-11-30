<?php

namespace Pav\Communicators;

use Illuminate\Support\ServiceProvider;

class YummlyCommServiceProvider extends ServiceProvider {


    public function register()
    {
        $this->app['YummlyCommunicator'] = $this->app->share(function($app)
        {
            return new YummlyCommunicator;
        });

        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('YummlyCommunicator', 'Pav\Communicators\Facades\YummlyCommunicator');
        });
    }
}