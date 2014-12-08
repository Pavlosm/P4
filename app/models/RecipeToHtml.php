<?php

namespace Pav\RecipeToHtml;


class RecipeToHtml {



    #region format recipe to html format

    /**
     * Returns the recipe in HTML format suitable for display
     *
     * @param $image string the image URL
     * @param $recipe string the recipe url already in html format
     * @param $ingredients array a string array containing the ingredients
     * @param $recId int ??
     * @param
     * @param
     * @param
     * @return string the html formatted recipe
     */
    public function recipeToHtml($image, $recipe, $ingredients, $recId,
                                 $searchParameters, $isLoggedIn, $includeContainer)
    {

        if ($includeContainer) {
            $ret  = '<div class="recipes">';
        } else {
            $ret = "";
        }

        $ret .=     '<div class="row" id="div'.$recId.'">';
        $ret .= $this->addImageRecipe($image, $recipe);
        $ret .=         '<div class="col-md-5">';

        if ($isLoggedIn) {
            $ret .= $this->Add_Refresh_Put_Buttons($recId);
        } else {
            $ret .= $this->GenerateRefreshButton($recId);
        }

        $ret .=         '</div>';
        $ret .=     '</div>';
        $ret .= $this->addHiddenSearchParameters($recId, $searchParameters);
        $ret .= $this->addIngredients($ingredients);
        if ($includeContainer) {
            $ret .= '</div>';
            $ret .= '<br/>';
        }

        return $ret;
    }


    public function noRecipeFound($includeContainer, $searchParameters)
    {
        if ($includeContainer) {
            $ret  = '<div class="recipes">';
        } else {
            $ret = "";
        }

        $ret .= 'No recipe found for: '.$searchParameters;

        if ($includeContainer) {
            $ret .= '</div>';
            $ret .= '<br/>';
        }
        return $ret;
    }


    public function recipeToHtml2($image, $recipe, $ingredients, $recId, $recipe2)
    {
        $ret  = '<div class="recipes">';

        $ret .=     '<div class="row" id="div'.$recId.'">';
        $ret .= $this->addImageRecipe($image, $recipe);
        $ret .= $this->addRating($recipe2);
        $ret .=         '<div class="col-md-3">';

        $ret .= $this->GenerateDeleteButton($recId);
        $ret .=         '</div>';
        $ret .=     '</div>';
        $ret .= $this->addIngredients($ingredients);
        $ret .= '</div><br />';
        return $ret;
    }

    #endregion


    #region Helper methods for html formatting

    private function addHiddenSearchParameters($recipe_id, $searchParameters)
    {
        $ret  =     '<div class="row hidden" style="display: none;">';
        $ret .=         '<div id="hid'.$recipe_id.'">';
        $ret .=             $searchParameters;
        $ret .=         '</div>';
        $ret .=     '</div>';
        return $ret;
    }


    private function addIngredients($ingredients)
    {
        $ret  = '<h4 class="h3toggle"><span class="glyphicon glyphicon-chevron-down">&nbspIngredients</span></h4>';
        $ret .= '<div class="cont">';

        if (is_array($ingredients)) {
            foreach ($ingredients as $ing) {
                $ret .= $ing."<br/>";
            }
        } else {
            $ret .= $ingredients."<br/>";
        }

        $ret .= '</div>';

        return $ret;
    }


    private function addImageRecipe($image, $recipe)
    {
        $ret  =         '<div class="col-md-2">';
        $ret .=             '<img src="'.$image.'" alt="recipe"/>';
        $ret .=         '</div>';
        $ret .=         '<div class="col-md-4">';
        $ret .=             $recipe;
        $ret .=         '</div>';
        return $ret;
    }


    private function addRating($recipe)
    {

        $rating = $recipe->rating;
        $ret  = '<div class="col-md-3">';
        $ret .= '<h4 class="h3toggle" id="r_'.$recipe->recipe.'">';
        $ret .=     '<span class="glyphicon glyphicon-chevron-down">&nbsp;Rating: '.$rating.'</span>';
        $ret .= '</h4>';
        $ret .= '<div class="cont">';
        $ret .= 'Change rating <br/>';
        $ret .=     '<select onchange="rateRecipe(this.id)" id="s_'.trim($recipe->recipe, '"').'">';
        $ret .=         '<option value="1">1</option>';
        $ret .=         '<option value="2">2</option>';
        $ret .=         '<option value="3">3</option>';
        $ret .=         '<option value="4">4</option>';
        $ret .=         '<option value="5">5</option>';
        $ret .=     '</select>';
        $ret .= '</div>';
        $ret .= '</div>';

        return $ret;
    }

    /**
     * Adds a refresh and a save button
     * @param
     * @return string
     */
    private function Add_Refresh_Put_Buttons($recUrl)
    {
        $ret  = $this->GenerateSaveButton($recUrl);
        $ret .= $this->GenerateRefreshButton($recUrl);
        return $ret;
    }

    #endregion


    #region Button generators

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
        $button .= 'onclick="refreshRecipe(this.id)">';
        $button .= '<span class="glyphicon glyphicon-refresh"/>&nbsp</span>Refresh</button><br/>';

        return $button;
    }

    #endregion
}