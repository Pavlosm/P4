<?php

class RegisterController extends BaseController {

    # Corresponds to the GET request
    public function showRegister() {
        return View::make('register');
    }

    # Corresponds to the POST request
    public function register() {

        # Validate the data against the validator
        $validator = $this->Validator();

        if ($validator->fails()) {
            return Redirect::to('/register')->with( 'flash_message',
                                                    'Sign up failed; please try again')
                                            ->withErrors($validator);
        }

        # now that data is valid create user
        $user = new User;

        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));

        # try to save the User and if it fails redirect to register
        # page sending an 'abstract' message and maintain input
        try {
            $user->save();
        } catch (Exception $e) {
            return Redirect::to('/register')->with( 'flash_message',
                                                    'Sign up failed; please try again')
                                            ->withInput();
        }

        # Login the User and redirect his/her page
        Auth::login($user);

        return Redirect::to('/main')->with('flash_message', 'Welcome');
    }


    private function Validator() {

        # Create the rules and validate the data

        $rules = array (
            'email' => 'required|email|unique:users',
            'password' => 'required|min:7',
            'password_confirmation' => 'required|same:password'
        );

        $validator = Validator::make(Input::all(), $rules);

        return $validator;
    }
}


