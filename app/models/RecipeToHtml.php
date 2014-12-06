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
        $ret .=         '<div class="col-md-2">';
        $ret .=             '<img src="'.$image.'" alt="recipe"/>';
        $ret .=         '</div>';
        $ret .=         '<div class="col-md-4">';
        $ret .=             $recipe;
        $ret .=         '</div>';
        $ret .=         '<div class="col-md-4">';

        if (is_array($ingredients)) {
            foreach ($ingredients as $ing) {
                $ret .= $ing."<br/>";
            }
        } else {
            $ret .= $ingredients."<br/>";
        }

        $ret .=         '</div>';
        $ret .=         '<div class="col-md-2">';

        if ($isLoggedIn) {
            $ret .= $this->Add_Refresh_Put_Buttons($recId);
        } else {
            $ret .= $this->GenerateRefreshButton($recId);
        }

        $ret .=         '</div>';
        $ret .=     '</div>';
        $ret .=     '<div class="row hidden" style="display: none;">';
        $ret .=         '<div id="hid'.$recId.'">';
        $ret .=             $searchParameters;
        $ret .=         '</div>';
        $ret .=     '</div>';

        if ($includeContainer) {
            $ret .= '</div>';
            $ret .= '<br/>';
        }

        return $ret;
    }

    /**
     * Adds a refresh and a save button
     * @return string
     */
    private function Add_Refresh_Put_Buttons($recUrl) {

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