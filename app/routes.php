<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

# /app/routes.php


#region test and debug

Route::get('/debug', 'DebugController@getDebug');
Route::get('/mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $databases = DB::select('SHOW DATABASES;');
    $recipes = Recipe::all();
    $users = User::all();
    # If the "Pre" package is not installed, you should output using print_r instead
    echo '<p>'.print_r($databases).'</p>';
    foreach($recipes as $recipe) {
        echo $recipe['recipe'] . "<br>";
    }

    foreach($users as $user) {
        echo $user['email'] . "<br>";
    }
});

Route::get('/test', function() {


    DatabaseManager::GetUserRecipes(7);
    //DatabaseManager::test();

    //return DatabaseManager::RemoveUserRecipe(7, 'r3ecipes');
    //return DatabaseManager::AddRecipeToUser('new recipe 1', 7);
});


Route::get('/test2', function() {
    return DatabaseManager::AddRecipeToUser('new recipe 3', 7);
    return DatabaseManager::test();
});

#endregion


#region register, login, logout and unregister routes

Route::get('/register', array('before' => 'guest', 'uses' => 'RegisterController@showRegister'));
Route::post('/register', array('before' => 'csrf', 'uses' => 'RegisterController@register'));


Route::get('/login',  array('before' => 'guest', 'uses' => 'LoginController@getLogin'));
Route::post('/login', array('before' => 'csrf', 'uses' => 'LoginController@postLogin'));


Route::get('/unregister', 'UnregisterController@showUnregister');
Route::post('/unregister', 'UnregisterController@unregister');



Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});

#endregion


#region homepage routes

Route::get('/', 'HomeController@getIndex');

Route::post('/', function() {
    $ingredients = Input::get('ingredients');
    return YummlyCommunicator::getRecipe($ingredients, false);
   // return View::Make('mainPage');
});

#endregion


#region logged in user page routes

Route::get('/main', 'MainPage@getIndex');

#endregion


