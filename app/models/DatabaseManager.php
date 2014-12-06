<?php


namespace Pav\DBManager;

use Recipe;
use User;
use Recipe_User;

class DatabaseManager {


    #region just recipe related functions

    /**
     * Adds a new recipe to the database if the recipe does
     * not already exist.
     *
     * @param $recipe string the recipe query
     * @return string
     */
    public function AddRecipe($recipe, $recipe_id) {

        $rec = Recipe::where('recipe', '=', $recipe)->get();

        if ($rec->isEmpty()) {
            $this->createRecipe($recipe, $recipe_id);
        }
    }

    private function createRecipe($recipe, $recipe_id) {

        $rec = new Recipe();
        $rec->recipe = $recipe;
        $rec->recipe_id = $recipe_id;
        $rec->save();

    }

    private function RemoveRecipe($recipe) {

        $rec = Recipe::where('recipe', '=', $recipe)->first();

        if ($rec) {
            try {
                $rec->delete();
            } catch ( Exception $e) {
                return "Got it!";
            }
        }
    }

    #endregion


    /**
     * Associates a user with the given recipe. If the recipe does not
     * already exist in the recipes table it adds a new recipe.
     *
     * Steps:
     *      1. Check that the given user exists ( if not just return )
     *      2. Find if there is a recipe in the recipe table. ( If not
     *         create a new and add it to the recipe table)
     *      3. Finally, if there is no duplicate recipe - user pair add
     *         a new row for that pair
     *
     * @param $recipe int the link of the recipe
     * @param $userId int the unique ID of the user in the user table
     *
     * @return string
     */
    public function AddRecipeToUser($userId, $recipe) {

        # try to get the user associated with the userId, if there is no
        # user then return ...
        $user = User::where('id', '=', $userId)->get();
        if ($user->isEmpty()) {
            return;
        }

        $currentUser = $user->first();
        # try to get the recipe from the recipe table and if there is no
        # recipe add a new one
        $rec = Recipe::where('recipe', '=', $recipe)->first();

        if (!$rec) {
            $rec = new Recipe();
            $rec->recipe = $recipe;
            $rec->save();
        }

        # Finally, If there is no duplicate user - recipe pair in the pivot
        # table add it.
        $rec->users()->attach($currentUser);
    }




    /**
     * Updates an existing user - recipe couple in the pivot table
     * with a new recipe. If the old recipe does not have any
     * other references in the pivot table it removes it from the
     * recipes table. If the new recipe does not exist in the
     * recipes table then a new entry for this recipe is created.
     *
     * Steps:
     *      1. Get the user recipe tuple
     *      2. If the old recipe does not have any other
     *         reference in the table remove the recipe
     *         from the recipes table.
     *
     *
     * @param $oldRecipeId int the unique ID of the
     *                         recipe to be removed
     * @param $recipe url te link of the new recipe
     * @param $userId int the unique ID of the user
     */
    public function UpdateUserRecipe($oldRecipeId, $recipe, $userId) {

        $user = User::find($userId);

        $rec = Recipe::where('recipe', '=', $recipe)->first();

        if (!$rec) {
            $rec = new Recipe();
            $rec->recipe = $recipe;
            $rec->save();
        }

        $user->recipes()->updateExistingPivot($oldRecipeId, array('recipe_id' => $rec->id), false);

    }

    /**
     * It removes the user from the database which means that it
     * also removes all entries of that user in the pivot table.
     * This means that all recipes that have no reference to any
     * other user must also be removed from the recipes table.
     *
     * steps:
     *      1. Get all recipes - user tuple from the pivot table
     *      2. For each recipe in these check if there any
     *         other references in the pivot table
     *      3. If there are no other then remove each the tuple
     *         from the pivot and then the recipe. Otherwise
     *         remove just the tuple.
     *      4. Finally remove the user
     *
     * @param $userId int the ID of the user
     */
    public function DeleteUser($userId) {
        $user = User::find($userId);
        $user->recipes()->detach();
        User::destroy($userId);
    }



    /**
     * Removes a recipe - user tuple from the pivot table, and if there is
     * no other entry in the pivot table with that recipe then it removes
     * the recipe from the recipes table.
     *
     * Steps:
     *      1. Get the user
     *      2. detach the recipe (no error if there is none)
     *      3. If there is no other entry for that recipe then go to the
     *         recipes table and remove the recipe
     *
     * @param $recipe string the unique ID of the recipe
     * @param $userId int the unique ID of the user
     */
    public function RemoveUserRecipe($userId, $recipe) {

        $r = Recipe::where('recipe', '=', $recipe)->first();

        $user = User::find($userId);
        $user->recipes()->detach($r);

        if ( $r && ! $r->users()->first() ) {
            Recipe::destroy($r->id);
        }
    }



    public function GetUserRecipes($userId) {

        return User::find($userId)->recipes;
    }



//    public function CreateRecipe($recipe) {
//
//        $rec = Recipe::where('recipe', '=', $recipe)->first();
//
//        if (!$rec) {
//            $rec = new Recipe();
//            $rec->recipe = $recipe;
//            $rec->save();
//        }
//    }
}