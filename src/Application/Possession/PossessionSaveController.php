<?php

namespace App\Application\Possession;

use App\Application\MainController;
use Symfony\Component\HttpFoundation\JsonResponse;

class PossessionSaveController extends MainController
{
    public function __invoke(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['Lucky corp' => $number]);
    }
}