<?php

namespace App\Entity;

use Carbon\Carbon;

class Ingredient
{
    public $title;
    public $bestBefore;
    public $usedBy;
    public $freshDateLevel;
    
    private $currentDate;

    public function __construct($title, $bestBefore, $usedBy, $currentDate = null)
    {
        $this->title        = $title;
        $this->bestBefore   = $bestBefore;
        $this->usedBy       = $usedBy;

        if($currentDate == null){
            $this->currentDate = Carbon::now();
        }else{
            $this->currentDate = Carbon::createFromFormat('Y-m-d', $currentDate);
        }

        // Set Fresh Date Level
        $usedBy     = Carbon::createFromFormat('Y-m-d', $this->usedBy);
        $dayDiff    = $usedBy->diffInDays($this->currentDate);

        if($this->isCanBeUsed()){
            $this->freshDateLevel = $dayDiff;
        }else{
            $this->freshDateLevel = $dayDiff * -1;
        }
        // End Set Fresh Date Level
    }

    public function isCanBeUsed()
    {
        $usedBy = Carbon::createFromFormat('Y-m-d', $this->usedBy);

        return $usedBy->greaterThanOrEqualTo($this->currentDate);
    }
}