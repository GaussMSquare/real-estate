<?php

namespace App\Application\Mandate;

use App\Application\MainController;
use Symfony\Component\HttpFoundation\JsonResponse;

class MandateFindController extends MainController
{
    public function __invoke(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['Lucky mandate' => $number]);
    }
}