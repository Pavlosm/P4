<?php

class UnregisterController extends BaseController {

    public function showUnregister() {
        return View::make('unregister');
    }

    public function unregister() {

        DatabaseManager::DeleteUser(Auth::user()->id);
        return View::make('unregistered');
    }


}
