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
    return View::make('test');
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
Route::post('/', 'HomeController@postIndex');
Route::post('/ajaxRefresh/{ingredients?}', 'HomeController@getRecipes');
//Route::post('ajax/{numOfRecipes}', 'HomeController@getFormForRecipes');

#endregion


#region logged in user page routes

Route::get('/main', 'MainPageController@getIndex');
Route::post('/main', 'MainPageController@postIndex');

#ajax
Route::post('main/refresh/{recipe}/{ingredients?}', 'MainPageController@refreshRecipe');
Route::post('main/save/{recipe}', 'MainPageController@saveRecipe');
Route::post('main/delete/{recipe}', 'MainPageController@deleteRecipe');


//Route::post('/main/ajax/{numOfRecipes}', 'MainPage@getTextBoxes');
//Route::post('/main/ajax/{numOfRecipes}', 'MainPageController@getFormForRecipes');
#endregion


#region whatever

//Route::post('ajax/{numOfRecipes}',

//    function ($numOfRecipes) {
//
//    if ($numOfRecipes == 0){
//        return;
//    }
//
//    $rec = intval($numOfRecipes);
//    $result = "<h3>Choose recipe ingredients</h3>";
//    $result .= "(<i>if you do not want to specify any ingredients just leave the text box empty and a random ingredient will be added)</i><br/>";
//    $result .= "<form action=\"\" method=\"POST\" >";
//    for ($i = 1; $i <= $rec; $i++) {
//        $result .= "<div class=\"row\"><div class=\"col-md-2 form\">";
//        $result .= "<label>Recipe ".$i.":</label></div><div class=\"col-md-10 form\">";
//        $result .= makeTextBox($i).'</div></div>';
//    }
//
//    $result .= "<div class=\"col-md-4\"></div><div class=\"col-md-4\"><input type=\"submit\" class=\"btn btn-primary  btn-block\" value=\"Get those recipes\"></div></form>";
//
//    return $result;
//});


//Route::post('/ajaxRefresh/{ingredients?}', function($ingredients = "") {
//    //return "done";
//    return YummlyCommunicator::getRecipe($ingredients, false, false);
//
//});

function makeTextBox($index) {
    $result = '<input type="text" name="ing'.$index.'" class="form-control"';
    $result .= ' placeholder="type comma separated ingredients to included in the recipe ingredients">';
    return $result;
}

Route::post('/ajax2/{recipe}/{value}',
    function ($recipe, $value) {

    $complete_recipe = "http://www.yummly.com/recipe/".$recipe;
    DatabaseManager::AddRecipeToUser(4, $complete_recipe);

    if (!strcasecmp($value, 'save')) {
        return '<span class="glyphicon glyphicon-remove-circle"/>&nbsp</span>Delete</button><br/>';
    } else if (!strcasecmp($value, 'refresh')) {
        return '<span class="glyphicon glyphicon-refresh"/>&nbsp</span>Refresh</button><br/>';
    } else if (!strcasecmp($value, 'delete')) {
        return '<span class="glyphicon glyphicon-remove-circle"/>&nbsp</span>Refresh</button><br/>';
    }

    return $value;
});


Route::get('/clearDB', function() {

    $ar = array (
        'Chicken-Paillards-with-Lemon_Butter-Sauce-Martha-Stewart',
        'http://www.yummly.com/recipe/ Baked-Cracker-Crusted-Chicken-Fingers-506606',
        'http://www.yummly.com/recipe/save',
        'http://www.yummly.com/recipe/ Home-made-chicken-nuggets-316679',
        'http://www.yummly.com/recipe/ Sausage-and-lentil-stew-slow-cooker-310314',
        'http://www.yummly.com/recipe/ Balsamic-chicken-and-mushrooms-309858',
        'http://www.yummly.com/recipe/ Sauteed-broccoli-with-garlic_-pine-nuts_-and-parmesan-309784',
        'http://www.yummly.com/recipe/ Pizza-pot-pies-333744',
        'http://www.yummly.com/recipe/ Roast-chicken-302413');

    foreach ($ar as $rec) {
        DatabaseManager::RemoveUserRecipe(4, $rec);
    }
});

#eendregion