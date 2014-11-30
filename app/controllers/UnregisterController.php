<?php

class UnregisterController extends BaseController {

    public function showUnregister() {
        return View::make('unregister');
    }

    public function unregister() {

        //if (Input::get('Yes')) {
        //    return "Yes";
        //}
        //else {
        //    return "no";
        //}
        DatabaseManager::DeleteUser(Auth::user()->id);
        return View::make('unregistered');
    }


}
