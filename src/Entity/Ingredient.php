<?php

namespace App\Entity;

class Ingredient
{
    public $title;
    public $bestBefore;
    public $usedBy;

    public function __construct($title, $bestBefore, $usedBy)
    {
        $this->title        = $title;
        $this->bestBefore   = $bestBefore;
        $this->usedBy       = $usedBy;
    }

    public function isPastDate($date)
    {
        return true;
    }
}