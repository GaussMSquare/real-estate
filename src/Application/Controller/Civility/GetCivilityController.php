<?php

namespace App\Application\Controller\Civility;

use App\Application\Handler\Civility\GetCivilityHandler;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetCivilityController extends AbstractController
{
    private GetCivilityHandler $getCivilityHandler;

    public function __construct(GetCivilityHandler $handler)
    {
        $this->getCivilityHandler = $handler;
    }

    /**
     * @throws Exception
     */
    public function __invoke(): JsonResponse
    {
        try {
            $result = $this->getCivilityHandler->handle();
            return $this->json($result, Response::HTTP_OK);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}