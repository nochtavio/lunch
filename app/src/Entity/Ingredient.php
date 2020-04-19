<?php

namespace App\Entity;

use Carbon\Carbon;

class Ingredient
{
    public $title;
    public $bestBefore;
    public $usedBy;
    public $unfreshLevel;
    
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

        // Set Unfresh Level
        $this->unfreshLevel = 0;
        if($this->isPassBestBefore()){
            $bestBefore = Carbon::createFromFormat('Y-m-d', $this->bestBefore);
            $dayDiff    = $bestBefore->diffInDays($this->currentDate);

            $this->unfreshLevel = $dayDiff;
        }
        // End Set Unfresh Level
    }

    public function isCanBeUsed()
    {
        $usedBy = Carbon::createFromFormat('Y-m-d', $this->usedBy);

        return $usedBy->greaterThanOrEqualTo($this->currentDate);
    }

    public function isPassBestBefore()
    {
        $bestBefore = Carbon::createFromFormat('Y-m-d', $this->bestBefore);

        return $this->currentDate->greaterThan($bestBefore);
    }
}