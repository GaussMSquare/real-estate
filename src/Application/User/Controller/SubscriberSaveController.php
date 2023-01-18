<?php

declare(strict_types=1);

namespace App\Application\User\Controller;

use App\Application\MainController;
use App\Domain\User\UserModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriberSaveController extends MainController
{
    /** @var SubscriberSaveHandler  */
    private $handler;

    public function __construct(SubscriberSaveHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $userModel = UserModel::arrayToModel(json_decode($request->getContent(), true));
        $this->handler->handle($userModel);

        return $this->json(null,Response::HTTP_CREATED);
    }
}