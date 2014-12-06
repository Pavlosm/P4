<?php

namespace Pav\RecipeToHtml;


class RecipeToHtml {



    public function GenerateSaveButton($recipe) {

        $button  = '<button class="form-control"';
        $button .= 'id="'.$recipe.'" ';
        $button .= 'value="save"';
        $button .= 'onclick="addRecipe(this.value, this.id)">';
        $button .= '<span class="glyphicon glyphicon-upload"/></span>Save</button><br/>';

        return $button;
    }


    public function GenerateDeleteButton($recipe) {

        $button  = '<button class="form-control"';
        $button .= 'id="'.$recipe.'" ';
        $button .= 'value="delete"';
        $button .= 'onclick="addRecipe(this.value, this.id)">';
        $button .= '<span class="glyphicon glyphicon-upload"/></span>Delete</button><br/>';

        return $button;
    }


    public function GenerateRefreshButton($recipe) {

        $button  = '<button class="form-control"';
        $button .= 'id="'.$recipe.'" ';
        $button .= 'value="refresh"';
        $button .= 'onclick="addRecipe(this.value, this.id)">';
        $button .= '<span class="glyphicon glyphicon-upload"/></span>Refresh</button><br/>';

        return $button;
    }
}