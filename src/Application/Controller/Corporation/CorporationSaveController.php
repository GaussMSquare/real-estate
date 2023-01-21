<?php

namespace App\Application\Controller\Corporation;

use App\Application\MainController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CorporationSaveController extends MainController
{
    public function __invoke(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['Lucky corp' => $number]);
    }
}