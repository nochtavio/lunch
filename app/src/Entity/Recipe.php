<?php

namespace App\Entity;

use App\Entity\Ingredient;

use Carbon\Carbon;

class Recipe
{
    public $title;
    public $ingredients;
    public $availableIngredients;
    public $unfreshLevel;

    public function __construct($title, $ingredients)
    {
        $this->title        = $title;
        $this->ingredients  = $ingredients;
    }

    public function setIngredients($ingredientsLists, $currentDate = null)
    {
        /**
         *  $ingredientsList    = list of ingredient objects (title, best-before, use-by)
         *  $currentDate        = Y-m-d formatted date
         */

        if($currentDate == null){
            $currentDate = Carbon::now()->format('Y-m-d');
        }
        
        $this->availableIngredients = [];
        $this->unfreshLevel         = 0;

        foreach ($this->ingredients as $key => $ingredient) {
            foreach ($ingredientsLists as $key2 => $ingredientList) {
                if($ingredient == $ingredientList->{'title'}){
                    $ingredientEntity = new Ingredient($ingredientList->{'title'}, $ingredientList->{'best-before'}, $ingredientList->{'use-by'}, $currentDate);

                    if($ingredientEntity->isCanBeUsed($currentDate)){
                        $this->availableIngredients[]   = (array) $ingredientEntity;

                        $this->setUnfreshLevel($ingredientEntity->unfreshLevel);

                        /** remove used ingredients from the list */
                        unset($ingredientsLists[$key2]);
                        $ingredientsLists = array_values($ingredientsLists);

                        /** exit the loop once ingredient is found */
                        break;
                    }
                }
            }
        }
    }

    public function setUnfreshLevel($unfreshLevel)
    {
        if($this->unfreshLevel < $unfreshLevel){
            $this->unfreshLevel = $unfreshLevel;
        }
    }

    public function isRecipeAvailable()
    {
        return count($this->ingredients) == count($this->availableIngredients);
    }

    public function getRecipe()
    {
        return [
            'title'         => $this->title,
            'ingredients'   => $this->ingredients,
            'unfresh_level' => $this->unfreshLevel
        ];
    }
}