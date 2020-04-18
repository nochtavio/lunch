<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Entity\Ingredient;

use Carbon\Carbon;

class LunchControllerTest extends WebTestCase
{
    /**
     *  note: the tests are running with static files in the logic
     */

    public function testLunchListWithSalad()
    {
        /** test to check salad is included */

        $client = static::createClient();

        $client->request('GET', '/lunch?date=2019-03-07');

        $content = json_decode($client->getResponse()->getContent());

        $validCount = 0;
        foreach ($content->recipes as $key => $value) {
            if($value->title == 'Salad'){
                $validCount++;
            }
        }

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($validCount == 1);
        
    }
}