<?php

namespace Pav\Communicators;
use Pav\RecipeToHtml\RecipeToHtml;



class YummlyCommunicator {


    #region properties

    # App credentials to use the Yummly API
    private $id = '82f96a5d';
    private $key = 'd7030bb5418a379b4ff59fb0473ba2c7';

    # base urls for search recipes and get recipes from Yummly
    private $getApiUrl  = 'http://api.yummly.com/v1/api/recipe/';
    private $searchApiUrl = 'http://api.yummly.com/v1/api/recipes';

    private $isLoggedIn;

    private $randomIngredients = array(
        'anchovies', 'apricots', 'aquavit', 'artichokes', 'asparagus',
        'beans', 'beef', 'black beans', 'broccoli', 'bruschetta', 'sprouts',
        'carrot', 'catfish', 'caviar', 'chicken', 'liver', 'chickpeas',
        'chile', 'Cabbage', 'chives', 'clams', 'cod', 'corn', 'couscous',
        'crabs', 'crayfish', 'cucumbers', 'curry', 'duck', 'dumpling', 'eggs',
        'eggplants', 'escalopes', 'falafel', 'fava', 'feta', 'hamburger',
        'jambalaya', 'lamb', 'lentils', 'liver', 'lobsters', 'mushrooms',
        'mussels', 'noodles', 'nori', 'octopus', 'pancetta', 'pasta', 'pork',
        'potatoes', 'Pumpkin', 'quesadilla', 'rabbit', 'rice', 'salmon', 'satay',
        'sausages', 'scallops', 'scaloppine', 'shrimp', 'soybeans', 'spinach',
        'swordfish', 'tortillas', 'turkey', 'vegan'
    );

    private $search_parameters;

    private $recipeToHtml;


    #endregion


    private function Initialize() {
        $this->getApiUrl  = 'http://api.yummly.com/v1/api/recipe/';
        $this->searchApiUrl = 'http://api.yummly.com/v1/api/recipes';
        $this->search_parameters = '';
        $this->recipeToHtml = new RecipeToHtml();
    }


    #region methods for getting the recipe

    /**
     * Gets a random recipe based on the ingredients passed
     *
     * @param $isLoggedIn bool true if user is logged in false otherwise
     * @param $ingredients array strings the ingredients " " separated
     * @param
     * @return string the recipe in HTML format
     */
    public function getRecipe($ingredients, $isLoggedIn, $includeContainer) {

        $this->Initialize();


        $this->isLoggedIn = $isLoggedIn;
        $this->search_parameters = $ingredients;

        if (trim($ingredients) == "") {
            $i = $this->randomIngredients[array_rand($this->randomIngredients)];
            $this->addIngredients($i);
        } else {
            $this->addIngredients($ingredients);
        }
        //return $this->searchApiUrl;
        $results =  $this->call($this->searchApiUrl);

        //return $results;
        return $this->getRandomRecipe($results, $includeContainer);
    }

    /**
     * Adds the ingredients in the string array to the searching query
     * and returns the query (url format) string.
     *
     * @param $ingredients array the string array with the ingredients
     * @return string the url query with the ingredients
     */
    private function addIngredients($ingredients) {

        $ingredients = trim($ingredients);
        $ing_array = explode(" ", $ingredients);

        $this->searchApiUrl .= '?_app_id='.$this->id.'&_app_key='.$this->key;
        $ingr = '&q=';
        if (is_array($ing_array)) {

            foreach($ing_array as $ing) {
                $ingr .= $ing.'+';
            }
        } else {
            $ingr .= $ing_array.'+';
        }
        $this->searchApiUrl .= rtrim($ingr, "+");

        $this->searchApiUrl .= '&maxResult=100';

        return $this->searchApiUrl;
    }


    private function addIngredients2($ingredients) {

        $ingredients = trim($ingredients);
        $ing_array = explode(",", $ingredients);

        $this->searchApiUrl .= '?_app_id='.$this->id.'&_app_key='.$this->key;

        if (is_array($ing_array)) {
            foreach($ing_array as $ing) {
                $this->searchApiUrl .= '&allowedIngredient[]='.$ing;
            }
        } else {
            $this->searchApiUrl .= '&allowedIngredient[]='.$ing_array;
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
     * @param
     * @return string the recipe in HTML format
     */
    private function getRandomRecipe($results, $includeContainer) {

        # pick a random number between either 0 - 100 or
        # 0 - totalMatchCount based on which is smaller
        $numberOfResults = $results['totalMatchCount'];

        if ($numberOfResults < 100) {
            $range = $numberOfResults;
        } else {
            $range = 100;
        }
        $recipeIndex = rand(0, intval($range));

        if ($recipeIndex == 0 ) {
            return $this->recipeToHtml->noRecipeFound($includeContainer, $this->search_parameters);
        }

        # get the recipe corresponding to the index above
        try {
            $this->getApiUrl .= $results['matches'][$recipeIndex]['id'];
        } catch (\ErrorException $e) {
            return $this->recipeToHtml->noRecipeFound($includeContainer, $this->search_parameters);
        }


        # create the url query to get the recipe and get it
        $this->getApiUrl .= '?_app_id='.$this->id.'&_app_key='.$this->key;
        $theRecipe = $this->call($this->getApiUrl);

        # obtain the required recipe parameters for display
        $pre = $theRecipe['attribution']['url'];
        $recId = str_replace("http://www.yummly.com/recipe/", "", $pre);


        $recURLLink = '<a class="image-provided" href="'.$theRecipe['attribution']['url'].'" target="blank">'
                      .$theRecipe['name'].'</a><br /><br />information provided by <img class="logo" src="'
                      .$theRecipe['attribution']['logo'].'"/>';

        try {
            $image = $theRecipe['images'][0]['hostedSmallUrl'];
        } catch (\ErrorException $e) {
            $image = 'No image available';
        }


        $ingredients = $theRecipe['ingredientLines'];

        return $this->recipeToHtml->recipeToHtml($image, $recURLLink, $ingredients, $recId, $this->search_parameters,
            $this->isLoggedIn, $includeContainer);
    }

    public function GetTheRecipe($recipeId, $recipe) {

        $this->Initialize();


        # get the recipe corresponding to the index above
        $this->getApiUrl .= $recipeId;

        # create the url query to get the recipe and get it
        $this->getApiUrl .= '?_app_id='.$this->id.'&_app_key='.$this->key;
        $theRecipe = $this->call($this->getApiUrl);

        # obtain the required recipe parameters for display
        $pre = $theRecipe['attribution']['url'];
        $recId = str_replace("http://www.yummly.com/recipe/", "", $pre);


        $recURLLink = '<a class="image-provided" href="'.$theRecipe['attribution']['url'].'" target="blank">'.$theRecipe['name'].
            '</a><br />information provided by <img class="logo" src="'.$theRecipe['attribution']['logo'].'"/>';
        $image = $theRecipe['images'][0]['hostedSmallUrl'];
        $ingredients = $theRecipe['ingredientLines'];

        return $this->recipeToHtml->recipeToHtml2($image, $recURLLink, $ingredients, $recId, $recipe);
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

        return $decoded;
    }

    #endregion

}