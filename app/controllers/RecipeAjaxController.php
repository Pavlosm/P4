<?php


class RecipeAjaxController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function handleRecipe($recipe, $value, $oldRecipe) {

        $user_id = Auth::user()->id;

        if (!strcasecmp($value, 'save')) {
            return $this->saveRecipe($recipe, $user_id);
        } else if (!strcasecmp($value, 'refresh')) {

        } else if (!strcasecmp($value, 'delete')) {
            return $this->deleteRecipe($user_id, $recipe);
        }
    }


    private function saveRecipe($recipe, $user_id) {

        DatabaseManager::AddRecipeToUser($user_id, $recipe);
        return '<span class="glyphicon glyphicon-remove-circle"/>&nbsp</span>Delete</button><br/>';

    }


    private function refreshRecipe($recipe, $oldRecipe, $user_id) {

        DatabaseManager::UpdateRecipeUser($oldRecipe, $recipe, $user_id);
        return '<span class="glyphicon glyphicon-refresh"/>&nbsp</span>Refresh</button><br/>';

    }


    private function deleteRecipe($user_id, $recipe_id) {

        DatabaseManager::RemoveUserRecipe($user_id, $recipe_id);
        return null;

    }


}