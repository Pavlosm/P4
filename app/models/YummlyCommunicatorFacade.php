<?php

namespace Pav\Communicators\Facades;

use Illuminate\Support\Facades\Facade ;

class YummlyCommunicator extends Facade {

    public static function getFacadeAccessor() {
        return 'YummlyCommunicator';
    }
}