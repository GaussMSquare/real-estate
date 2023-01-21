<?php

namespace App\Application\Controller\Country;

use App\Application\Handler\Country\GetCountryHandler;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetCountryController extends AbstractController
{
    private GetCountryHandler $getCountryHandler;
    public function __construct(GetCountryHandler $handler)
    {
        $this->getCountryHandler = $handler;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(): JsonResponse
    {
        try {
            $result = $this->getCountryHandler->handle();
            return $this->json($result, Response::HTTP_OK);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}