<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Ingredient;

class LunchController extends AbstractController
{
    /**
     *  @Route("/lunch", name="lunch_list")
     */
    public function index()
    {
        // Load External JSON Files
        $directory      = $this->getParameter('kernel.project_dir');

        $ingredients    = json_decode(file_get_contents($directory . '/config/files/ingredients.json'));
        $recipes        = json_decode(file_get_contents($directory . '/config/files/recipes.json'));
        // End Load External JSON Files

        dump($ingredients);

        return $this->json(['data' => 'test']);
    }
}