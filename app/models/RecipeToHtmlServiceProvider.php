<?php

namespace Pav\RecipeToHtml;

use Illuminate\Support\ServiceProvider;


class RecipeToHtmlServiceProvider extends ServiceProvider {


    public function register()
    {
        $this->app['RecipeToHtml'] = $this->app->share(function($app)
        {
            return new RecipeToHtml();
        });

        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('RecipeToHtml', 'Pav\RecipeToHtml\Facades\RecipeToHtml');
        });
    }

}