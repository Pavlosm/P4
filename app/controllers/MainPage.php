<?php


class MainPage extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function getIndex() {
        return View::Make('mainPage');
    }

}