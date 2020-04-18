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

        $today      = Carbon::now()->format('Y-m-d');

        $title      = 'Some Title';
        $bestBefore = Carbon::now()->format('Y-m-d');
        $usedBy     = Carbon::now()->addDays(5)->format('Y-m-d');

        $ingredient = new Ingredient($title, $bestBefore, $usedBy, $today);

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

        $ingredient = new Ingredient($title, $bestBefore, $usedBy, $today);

        $canBeUsed  = $ingredient->isCanBeUsed();

        $this->assertTrue($canBeUsed);
    }

    public function testSetFreshDateLevelWithCanBeUsedIngredient()
    {
        /** test set can be used ingredient freshdate level */

        $today      = Carbon::now()->format('Y-m-d');

        $title      = 'Some Title';
        $bestBefore = Carbon::now()->format('Y-m-d');
        $usedBy     = Carbon::now()->addDays(5)->format('Y-m-d');

        $ingredient = new Ingredient($title, $bestBefore, $usedBy, $today);

        $this->assertTrue($ingredient->freshDateLevel == 5);
    }

    public function testSetFreshDateLevelWithCannotBeUsedIngredient()
    {
        /** test set cant be used ingredient freshdate level */

        $today      = Carbon::now()->format('Y-m-d');

        $title      = 'Some Title';
        $bestBefore = Carbon::now()->subDays(7)->format('Y-m-d');
        $usedBy     = Carbon::now()->subDays(5)->format('Y-m-d');

        $ingredient = new Ingredient($title, $bestBefore, $usedBy, $today);

        $this->assertTrue($ingredient->freshDateLevel == -5);
    }
}