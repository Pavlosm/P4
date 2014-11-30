<?php

namespace Pav\DBManager\Facades;

use Illuminate\Support\Facades\Facade ;

class DatabaseManager extends Facade {

    public static function getFacadeAccessor() {
        return 'DatabaseManager';
    }
}