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

}
