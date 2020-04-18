<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LunchController
{
    /**
     *  @Route("/lunch", name="lunch_list")
     */
    public function index()
    {
        $response = new Response();
        $response->setContent(json_encode([
            'data' => 123,
        ]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}