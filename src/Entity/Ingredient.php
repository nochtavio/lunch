<?php

namespace App\Entity;

use Carbon\Carbon;

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

    public function isCanBeUsed($currentDate = null)
    {
        /**
         *  $currentDate = can be filled with Y-m-d formatted date
         */

        if($currentDate == null){
            $currentDate = Carbon::now();
        }else{
            $currentDate = Carbon::createFromFormat('Y-m-d', $currentDate);
        }

        $usedBy = Carbon::createFromFormat('Y-m-d', $this->usedBy);

        return $usedBy->greaterThanOrEqualTo($currentDate);
    }
}