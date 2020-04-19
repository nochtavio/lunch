<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;

use App\Entity\Recipe;

use Carbon\Carbon;

class RecipeTest extends TestCase
{
    public function testSetIngredientsWithAllAvailableIngredient()
    {
        /** test set recipe ingredients with all available ingredients */

        $today          = Carbon::now()->format('Y-m-d');

        $title          = 'Some Recipe Title';
        $ingredients    = ['Ingre 1', 'Ingre 2'];

        // Ingredient 1
        $ingredient1 = [
            'title'         => 'Ingre 1',
            'best-before'   => Carbon::now()->format('Y-m-d'),
            'use-by'        => Carbon::now()->format('Y-m-d')
        ];
        // End Ingredient 1

        // Ingredient 2
        $ingredient2 = [
            'title'         => 'Ingre 2',
            'best-before'   => Carbon::now()->format('Y-m-d'),
            'use-by'        => Carbon::now()->format('Y-m-d')
        ];
        // End Ingredient 2

        // Ingredient 3
        $ingredient3 = [
            'title'         => 'Ingre 3',
            'best-before'   => Carbon::now()->format('Y-m-d'),
            'use-by'        => Carbon::now()->format('Y-m-d')
        ];
        // End Ingredient 3

        $ingredientsList = [];
        $ingredientsList[] = (object) $ingredient1;
        $ingredientsList[] = (object) $ingredient2;
        $ingredientsList[] = (object) $ingredient3;

        $recipeEntity   = new Recipe($title, $ingredients);

        $recipeEntity->setIngredients($ingredientsList, $today);
        
        $validCount = 0;
        foreach ($recipeEntity->availableIngredients as $key => $availableIngredient) {
            if($availableIngredient['title'] == 'Ingre 1'){
                $validCount++;
            }

            if($availableIngredient['title'] == 'Ingre 2'){
                $validCount++;
            }

            if($availableIngredient['title'] == 'Ingre 3'){
                $validCount--;
            }
        }

        $this->assertTrue($validCount == 2);
    }

    public function testSetIngredientsWithSomeAvailableIngredient()
    {
        /** test set recipe ingredients with some available ingredients */

        $today          = Carbon::now()->format('Y-m-d');

        $title          = 'Some Recipe Title';
        $ingredients    = ['Ingre 1', 'Ingre 2'];

        // Ingredient 1
        $ingredient1 = [
            'title'         => 'Ingre 1',
            'best-before'   => Carbon::now()->format('Y-m-d'),
            'use-by'        => Carbon::now()->format('Y-m-d')
        ];
        // End Ingredient 1

        // Ingredient 2
        $ingredient2 = [
            'title'         => 'Ingre 2',
            'best-before'   => Carbon::now()->subDays(7)->format('Y-m-d'),
            'use-by'        => Carbon::now()->subDays(5)->format('Y-m-d')
        ];
        // End Ingredient 2

        // Ingredient 3
        $ingredient3 = [
            'title'         => 'Ingre 3',
            'best-before'   => Carbon::now()->format('Y-m-d'),
            'use-by'        => Carbon::now()->format('Y-m-d')
        ];
        // End Ingredient 3

        $ingredientsList = [];
        $ingredientsList[] = (object) $ingredient1;
        $ingredientsList[] = (object) $ingredient2;
        $ingredientsList[] = (object) $ingredient3;

        $recipeEntity   = new Recipe($title, $ingredients);

        $recipeEntity->setIngredients($ingredientsList, $today);
        
        $validCount = 0;
        foreach ($recipeEntity->availableIngredients as $key => $availableIngredient) {
            if($availableIngredient['title'] == 'Ingre 1'){
                $validCount++;
            }

            if($availableIngredient['title'] == 'Ingre 2'){
                $validCount--;
            }

            if($availableIngredient['title'] == 'Ingre 3'){
                $validCount--;
            }
        }

        $this->assertTrue($validCount == 1);
    }
}