<?php

namespace App\Application\Corporation;

use App\Application\MainController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CorporationDeleteController extends MainController
{
    public function __invoke(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['Lucky corp' => $number]);
    }
}