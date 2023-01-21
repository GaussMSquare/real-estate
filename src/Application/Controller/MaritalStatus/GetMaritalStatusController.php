<?php

namespace App\Application\Controller\MaritalStatus;

use App\Application\Handler\MaritalStatus\GetMaritalStatusHandler;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetMaritalStatusController extends AbstractController
{
    private GetMaritalStatusHandler $getMaritalStatusHandler;

    public function __construct(GetMaritalStatusHandler $handler)
    {
        $this->getMaritalStatusHandler = $handler;
    }

    /**
     * @throws Exception
     */
    public function __invoke(): JsonResponse
    {
        try {
            $result = $this->getMaritalStatusHandler->handle();
            return $this->json($result, Response::HTTP_OK);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}