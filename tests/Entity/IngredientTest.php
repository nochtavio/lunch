<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;

use App\Entity\Ingredient;

use Carbon\Carbon;

class IngredientTest extends TestCase
{
    public function testIsPastDateSuccessWithFutureUsedByDate()
    {
        /** test ingredient with used by date 5 days from today */

        $title      = 'Some Title';
        $bestBefore = Carbon::now()->format('Y-m-d');
        $usedBy     = Carbon::now()->addDays(5)->format('Y-m-d');

        $ingredient = new Ingredient($title, $bestBefore, $usedBy);

        $canBeUsed  = $ingredient->isCanBeUsed();

        $this->assertTrue($canBeUsed);
    }

    public function testIsPastDateSuccessWithTodayUsedByDate()
    {
        /** test ingredient with used by date with today date */

        $today      = Carbon::now()->format('Y-m-d');

        $title      = 'Some Title';
        $bestBefore = Carbon::now()->format('Y-m-d');
        $usedBy     = Carbon::now()->format('Y-m-d');

        $ingredient = new Ingredient($title, $bestBefore, $usedBy);

        $canBeUsed  = $ingredient->isCanBeUsed($today);

        $this->assertTrue($canBeUsed);
    }
}