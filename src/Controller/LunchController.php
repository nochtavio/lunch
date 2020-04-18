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
        return new Response(
            '<html><body>Hello</body></html>'
        );
    }
}