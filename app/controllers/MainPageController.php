<?php


class MainPageController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function getIndex() {

        return View::Make('mainPage');
    }

    public function postIndex() {

        $numOfRecipes = Input::get('numOfDays');

        $results = "";

        for($i =1; $i <= $numOfRecipes; $i++) {
            $name = 'ing'.$i;
            $results .= YummlyCommunicator::getRecipe(Input::get($name), true, true);
        }

        return View::Make('mainPage')->with('response', $results);
    }



    public function getRecipes($ingredients = "") {
        return YummlyCommunicator::getRecipe($ingredients, false, false);
    }


    public function saveRecipe($recipe) {

        $the_recipe = "http://www.yummly.com/recipe/".$recipe;

        DatabaseManager::AddRecipeToUser($user = Auth::user()->id, $the_recipe);

        return $this->GenerateDeleteButton($recipe);
    }


    public function deleteRecipe($recipe) {

        $the_recipe = "http://www.yummly.com/recipe/".$recipe;
        DatabaseManager::RemoveUserRecipe($user = Auth::user()->id, $the_recipe);
        return "done";
    }



    public function refreshRecipe($recipe, $ingredients = "") {
        return YummlyCommunicator::getRecipe($ingredients, true, false);
    }



    public function GenerateSaveButton($recipe) {

        $button  = '<button class="form-control"';
        $button .= 'id="a_'.$recipe.'" ';
        $button .= 'onclick="saveRecipe(this)">';
        $button .= '<span class="glyphicon glyphicon-upload"/>&nbsp</span>Save</button><br/>';

        return $button;
    }


    public function GenerateDeleteButton($recipe) {

        $button  = '<button class="form-control"';
        $button .= 'id="a_'.$recipe.'" ';
        $button .= 'onclick="deleteRecipe(this.id)">';
        $button .= '<span class="glyphicon glyphicon-upload"/>&nbsp</span>Delete</button><br/>';

        return $button;
    }


    public function GenerateRefreshButton($recipe) {

        $button  = '<button class="form-control"';
        $button .= 'id="'.$recipe.'" ';
        $button .= 'value="refresh"';
        $button .= 'onclick="addRecipe(this, this.id, this.value)">';
        $button .= '<span class="glyphicon glyphicon-refresh"/>&nbsp</span>Refresh</button><br/>';

        return $button;
    }


    public function GenerateSimpleRefreshButton($recipe) {

        $button  = '<button class="form-control"';
        $button .= 'id="'.$recipe.'" ';
        $button .= 'onclick="refreshRecipe(this.id)">';
        $button .= '<span class="glyphicon glyphicon-refresh"/>&nbsp</span>Refresh</button><br/>';

        return $button;
    }

    #region unused

//    public function getFormForRecipes($numOfRecipes) {
//
//        if ($numOfRecipes == 0)
//            return;
//        else if ($numOfRecipes > 7 || $numOfRecipes < 1)
//            return "Error: invalid number of recipes";
//
//
//        $rec = intval($numOfRecipes);
//        $result = "<h3>Choose recipe ingredients</h3>";
//
//        $result .= "(<i>if you do not want to specify any ingredients just leave the text box empty and a random ingredient will be added)</i><br/>";
//        $result .= '<form action="main" method="POST" >';
//        for ($i = 1; $i <= $rec; $i++) {
//            $result .= "<div class=\"row\"><div class=\"col-md-2 form\">";
//            $result .= "<label>Recipe ".$i.":</label></div><div class=\"col-md-10 form\">";
//            $result .= $this->makeTextBox($i).'</div></div>';
//        }
//
//        $result .= "<div class=\"col-md-4\"></div><div class=\"col-md-4\"><input type=\"submit\" class=\"btn btn-primary  btn-block\" value=\"Get those recipes\"></div></form>";
//
//        return $result;
//    }
//
//    private function makeTextBox($index) {
//        $result = '<input type="text" name="ing'.$index.'" class="form-control"';
//        $result .= ' placeholder="type comma separated ingredients to included in the recipe ingredients">';
//        return $result;
//    }

    #endregion
}