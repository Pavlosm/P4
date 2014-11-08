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
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});


Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/Test', function() {

    echo "Environment: ".App::environment();
});

Route::get('/', function(){
   return View::make('homepage');
});


Route::get('/login', function() {
    return View::make('login');
});


Route::get('/register', function() {
    return View::make('register');
});


function Get_Num_Pages($word) {


    $rec = 'http://www.bbc.co.uk/food/recipes/search?keywords=chicken&x=0&y=0&occasions%5B%5D=&chefs%5B%5D=&programmes%5B%5D=';//'http://www.food.com/recipe-finder/all/chicken';

    $contents = file_get_contents($rec);

//    // get the list items"/<div class=\"rz-pagi\">(.*?)<\/div>/s"/<div class=\"sr-recipe-item-e\">(.*?)<\/div>/s
//    preg_match_all("/<div id=\"article-list\"><ul>(.*?)<\/ul><\/div>/s", $contents, $out);
//
//    $out2 = array_filter($out);
//
//    if(empty($out2)) {
//        return 'Empty1';
//    }
//
//    //return Array_To_String($out);
//    $a = Array_To_String($out);
//    preg_match_all("/<div id=\"article-list\">(.*?)<\/div>/s", $a, $out3);
//
//    $out4 = array_filter($out3);
//
//    if(empty($out4)) {
//        return 'Empty2';
//    }
//
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($contents);
    libxml_use_internal_errors(true);
    $element =  $dom->getElementById("article-list");

    $res = '';
    foreach ($element->childNodes as $el) {
        $res .= "<p>".$el->textContent." ".$el->nodeValue;
    }
    return $res;
    return Array_To_String($out3);

}

function Array_To_String($array)
{
    $arr = '';

    foreach($array[0] as $a) {
        $arr .= $a;
    }
    return $arr;
}


Route::get('/main', function() {

    $id = '82f96a5d';
    $key = 'd7030bb5418a379b4ff59fb0473ba2c7';
    $q = 'http://api.yummly.com/v1/api/recipe/Avocado-cream-pasta-sauce-recipe-306039?_app_id='.$id.'&_app_key='.$key;


    $curl_handle=curl_init();
    curl_setopt_array(
        $curl_handle,
        array (
            CURLOPT_URL => $q,
            CURLOPT_CONNECTTIMEOUT => 2,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERAGENT => 'myApp',

        )
    );

    $query = curl_exec($curl_handle);
    curl_close($curl_handle);

    $decoded = json_decode($query, true);

    $response = $decoded['attribution']['html'];
    return View::Make('mainPage')->with('response', $response);
});

Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo print_r($results);

});



