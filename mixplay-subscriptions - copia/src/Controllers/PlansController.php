<?php

namespace Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class PlansController
{
    public function __invoke(Request $request, Response $response, array $argc)
    {
        return $response->withJson([
            ['name' => 'mensual' , 'price' => 199.99],
            ['name' => '6 meses' , 'price' => 1999.99],
            ['name' => '12 meses' , 'price' => 3999.99],
        ]);
    }
}