<?php

namespace App\Application\Controller\User;

use App\Controller\MainController;
use Symfony\Component\HttpFoundation\JsonResponse;

class OwnerSaveController extends MainController
{
    public function __invoke(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['Lucky owner' => $number]);
    }
}