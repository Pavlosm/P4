<?php

class HomeController extends BaseController {

	public function getIndex()
	{
		return View::make('homepage');
	}

    public function postIndex()
    {
        $numOfRecipes = Input::get('numOfDays');

        $results = "";

        for($i =1; $i <= $numOfRecipes; $i++) {
            $name = 'ing'.$i;
            $results .= YummlyCommunicator::getRecipe(Input::get($name), false, true);
        }

        return View::Make('homepage')->with('response', $results);
    }


    public function getRecipes($ingredients = "") {
        return YummlyCommunicator::getRecipe($ingredients, false, false);
    }


    #region Unused

//    public function getFormForRecipes($numOfRecipes) {
//
//        if ($numOfRecipes == 0)
//            return ;
//        else if ($numOfRecipes > 7 || $numOfRecipes < 1)
//            return "Error: invalid number of recipes";
//
//
//        $rec = intval($numOfRecipes);
//        $result = "<h3>Choose recipe ingredients</h3>";
//
//        $result .= "(<i>if you do not want to specify any ingredients just leave the text box empty and a random ingredient will be added)</i><br/>";
//        $result .= "<form action=\"\" method=\"POST\" >";
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
//
//    private function makeTextBox($index) {
//        $result = '<input type="text" name="ing'.$index.'" class="form-control"';
//        $result .= ' placeholder="type comma separated ingredients to included in the recipe ingredients">';
//        return $result;
//    }

    #endregion

}
