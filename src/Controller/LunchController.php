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
        // $ingredient = new Ingredient;

        // $test = $ingredient->test();
        // dump(__DIR__);

        $ingredients = json_decode(file_get_contents($this->getParameter('kernel.project_dir') . '/config/files/ingredients.json'));

        dump($ingredients);

        return $this->json(['data' => 'test']);
    }
}