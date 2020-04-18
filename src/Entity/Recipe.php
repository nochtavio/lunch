<?php

namespace App\Entity;

class Recipe
{
    public $title;
    public $ingredients;

    public function __construct($title, $ingredients)
    {
        $this->title        = $title;
        $this->ingredients  = $ingredients;
    }
}