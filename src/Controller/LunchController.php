<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Recipe;

class LunchController extends AbstractController
{
    /**
     *  @Route("/lunch", name="lunch_list")
     */
    public function index(Request $request)
    {
        $date = $request->query->get('date');
        
        // Load External JSON Files
        $directory = $this->getParameter('kernel.project_dir');

        $ingredientsFile    = json_decode(file_get_contents($directory . '/config/files/ingredients.json'));
        $recipesFile        = json_decode(file_get_contents($directory . '/config/files/recipes.json'));
        // End Load External JSON Files

        // Get Recipes with List of Ingredients
        $availableRecipes = [];
        foreach ($recipesFile->recipes as $key => $recipe) {
            $recipeEntity = new Recipe($recipe->title, $recipe->ingredients);

            $recipeEntity->setIngredients($ingredientsFile->ingredients, $date);

            if($recipeEntity->isRecipeAvailable()){
                $availableRecipes[] = $recipeEntity->getRecipe();
            }
        }
        // End Get Recipes with List of Ingredients

        return $this->json(['recipes' => $availableRecipes]);
    }
}