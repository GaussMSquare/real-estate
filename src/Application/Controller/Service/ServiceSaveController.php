<?php

namespace App\Application\Controller\Service;

use App\Application\MainController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServiceSaveController extends MainController
{
    public function __invoke(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['Lucky srv' => $number]);
    }
}