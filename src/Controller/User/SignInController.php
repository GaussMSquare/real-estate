<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function findUser(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['Lucky number' => $number]);
    }

    public function createUser(Request $request): JsonResponse
    {
        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}