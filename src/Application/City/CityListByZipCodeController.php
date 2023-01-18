<?php

namespace App\Application\City;

use App\Application\MainController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CityListByZipCodeController extends MainController
{
    public function __invoke(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['Lucky city' => $number]);
    }
}