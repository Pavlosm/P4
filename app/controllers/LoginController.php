<?php

class LoginController extends BaseController {

    # Corresponds to GET request
    public function getLogin() {
        return View::make('login');
    }

    # Corresponds to POST request
    public function postLogin() {

        # validate that input is given just that
        $validator = $this->Validator();

        if ($validator->fails()) {
            return Redirect::to('/login')->with('flash_message', 'Sign up failed; please try again')
                                         ->withErrors($validator);
        }

        $credentials = Input::only('email', 'password');
        $remember = (Input::get('keepLoggedIn') == 'yes') ? true : false;

        if (Auth::attempt($credentials, $remember )) {

            return Redirect::intended('/main')->with('flash_message', 'Welcome Back!');
        }
        else {
            return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
        }


        return Redirect::to('/login');
    }


    private function Validator() {

        # Create the rules and validate the data

        $rules = array (
            'email' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        return $validator;
    }


}
