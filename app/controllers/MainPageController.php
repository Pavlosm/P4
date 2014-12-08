<?php


class MainPageController extends BaseController {


    public function __construct() {
        $this->beforeFilter('auth');
    }


    /**
     * @return mixed
     */
    public function getIndex() {

        return View::Make('mainPage');
    }


    /**
     * @return mixed
     */
    public function postIndex()
    {
        # check which submit button was clicked

        if (Input::get('get_my_recipes') != null) {
            return View::Make('mainPage')->with('response', $this->getMyRecipesSubmit());
        } else {
            return View::Make('mainPage')->with('response', $this->getNewRecipesSubmit());
        }

    }

    private function getMyRecipesSubmit()
    {
        $result = "";
        $user = Auth::user();

        $recipes = $user->recipes;

        foreach ($recipes as $recipe) {

            $result .= YummlyCommunicator::GetTheRecipe($recipe->recipe, $recipe);
        }
        return $result;
    }


    private function getNewRecipesSubmit()
    {
        $numOfRecipes = Input::get('numOfDays');

        $results = "";

        for($i =1; $i <= $numOfRecipes; $i++) {
            $name = 'ing'.$i;
            $results .= YummlyCommunicator::getRecipe(Input::get($name), true, true);
        }

        return $results;

    }

    /**
     * @param string $ingredients
     * @return mixed
     */
    public function getRecipes($ingredients = "") {
        return YummlyCommunicator::getRecipe($ingredients, false, false);
    }


    #region ajax queries

    /**
     * @param $recipe
     * @return mixed
     */
    public function saveRecipe($recipe) {

        DatabaseManager::AddRecipeToUser($user = Auth::user()->id, $recipe);

        return RecipeToHtml::GenerateDeleteButton($recipe);
    }


    /**
     * @param $recipe
     * @return string
     */
    public function deleteRecipe($recipe) {

        $recipe;
        DatabaseManager::RemoveUserRecipe($user = Auth::user()->id, $recipe);
        return "done";
    }


    /**
     * @param $recipe
     * @param string $ingredients
     * @return mixed
     */
    public function refreshRecipe($recipe, $ingredients = "") {
        return YummlyCommunicator::getRecipe($ingredients, true, false);
    }


    public function changeRecipeRating($recipe, $rating) {

        # add validator that is int and between 1-3

        if (!is_numeric($rating)) {
            return "error";
        }

        $rat = intval($rating);

        if ($rating < 1 || $rating > 5) {
            return 'error';
        }

        $rec = Recipe::where('recipe', '=', $recipe)->first();

        $rec->rating = $rat;
        $rec->save();

        #return the new
        return '<span class="glyphicon glyphicon-chevron-down">&nbsp;Rating: '.$rec->rating.'</span>';

    }

    #endregion



}