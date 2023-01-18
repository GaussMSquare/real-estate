<?php

namespace App\Application\Country;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CountryListController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['Lucky country' => $number]);
    }
}