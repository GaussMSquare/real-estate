<?php

namespace App\Application\Controller\City;

use App\Application\MainController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CityListController extends MainController
{
    public function __invoke(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['Lucky city' => $number]);
    }
}