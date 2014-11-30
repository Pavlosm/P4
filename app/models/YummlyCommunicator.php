<?php

namespace Pav\Communicators;

class YummlyCommunicator {

    # App credentials to use the Yummly API
    private $id = '82f96a5d';
    private $key = 'd7030bb5418a379b4ff59fb0473ba2c7';

    # base urls for search recipes and get recipes from Yummly
    private $getApiUrl  = 'http://api.yummly.com/v1/api/recipe/';
    private $searchApiUrl = 'http://api.yummly.com/v1/api/recipes';

    private $isLoggedIn;

    /**
     * Gets a random recipe based on the ingredients passed
     *
     * @param $isLoggedIn bool true if user is logged in false otherwise
     * @param $ingredients array strings the ingredients " " separated
     * @return string the recipe in HTML format
     */
    public function getRecipe($ingredients, $isLoggedIn) {
        $this->isLoggedIn = $isLoggedIn;
        //return $this->isLoggedIn ? 'true' : 'false';
        $this->addIngredients($ingredients);
        $results =  $this->call($this->searchApiUrl);


        return $this->getRandomRecipe($results);
    }

    /**
     * Adds the ingredients in the string array to the searching query
     * and returns the query (url format) string.
     *
     * @param $ingredients array the string array with the ingredients
     * @return string the url query with the ingredients
     */
    private function addIngredients($ingredients) {
        $ing_array = explode(" ", $ingredients);

        $this->searchApiUrl .= '?_app_id='.$this->id.'&_app_key='.$this->key;

        foreach($ing_array as $ing) {
            $this->searchApiUrl .= '&allowedIngredient[]='.$ing;
        }

        $this->searchApiUrl .= '&maxResult=100';

        return $this->searchApiUrl;
    }

    /**
     * Given a JSON decoded array representing the search results of the
     * query, it picks a random result from the matches and makes the
     * call to Yummly API to get a random recipe.
     *
     * @param $results array the JSON decoded array of the search results
     * @return string the recipe in HTML format
     */
    private function getRandomRecipe($results) {

        # pick a random number between either 0 - 100 or
        # 0 - totalMatchCount based on which is smaller
        $numberOfResults = $results['totalMatchCount'];
        if ($numberOfResults < 100) {
            $range = $numberOfResults;
        } else {
            $range = 100;
        }
        $recipeIndex = rand(0, intval($range));

        # get the recipe corresponding to the index above
        $this->getApiUrl .= $results['matches'][$recipeIndex]['id'];

        # create the url query to get the recipe and get it
        $this->getApiUrl .= '?_app_id='.$this->id.'&_app_key='.$this->key;
        $theRecipe = $this->call($this->getApiUrl);

        # obtain the required recipe parameters for display
        $recURL = $theRecipe['attribution']['html'];
        $image = $theRecipe['images'][0]['hostedSmallUrl'];
        $ingredients = $theRecipe['ingredientLines'];

        return $this->recipeToHtml($image, $recURL, $ingredients);
    }

    /**
     * Makes the call to the Yummly API and gets back the results.
     * It decodes the json string and returns it.
     * @param $url string the URL that performs the search
     * @return mixed the decoded json of the response
     */
    private function call($url) {
        $curl_handle = curl_init();
        curl_setopt_array(
            $curl_handle,
            array (
                CURLOPT_URL => $url,
                CURLOPT_CONNECTTIMEOUT => 2,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_USERAGENT => 'myApp',
            )
        );

        $res = curl_exec($curl_handle);
        curl_close($curl_handle);


        $decoded = json_decode($res, true);
        //if (is_null($decoded)) {
        //    throw new Exception('No match found for: ');
        //}

        return $decoded;
    }

    /**
     * Returns the recipe in HTML format suitable for display
     *
     * @param $image string the image URL
     * @param $recipe string the recipe url already in html format
     * @param $ingredients array a string array containing the ingredients
     * @return string the html formated recipe
     */
    private function recipeToHtml($image, $recipe, $ingredients) {

        $ret  = '<div class="row recipes">';
        $ret .= '<div class="col-md-2"><img src="'.$image.'" alt="recipe"/></div>';
        $ret .= '<div class="col-md-4">'.$recipe.'</div>';
        $ret .= '<div class="col-md-4">';

        foreach ($ingredients as $ing) {
            $ret .= $ing."<br/>";
        }
        $ret .= '</div>';

        if ($this->isLoggedIn) {
            $ret .= '<div class="col-md-2">'.$this->Add_Refresh_Put_Buttons().'</div></div><br/>';
        }


        return $ret;
    }

    /**
     * Adds a refrush and a save button
     * @return string
     */
    private function Add_Refresh_Put_Buttons() {
        $ret  = '<form action="POST" class="form-signin">';
        $ret .= '<button class="form-control"><span class="glyphicon glyphicon-upload"/></span> Update</button><br/>';
        $ret .= '<button class="form-control"><span class="glyphicon glyphicon-refresh"/></span>Refresh</button>';
        $ret .= '</form>';
        return $ret;
    }
}