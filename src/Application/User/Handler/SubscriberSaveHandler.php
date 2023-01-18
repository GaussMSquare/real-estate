<?php

declare(strict_types=1);

namespace App\Application\User\Handler;

use App\Domain\User\UserModel;
use App\Infrastructure\Repository\SubscriberRepositoryInterface;

class SubscriberSaveHandler
{
    /** @var SubscriberRepositoryInterface */
    private SubscriberRepositoryInterface $subscriberRepository;

    public function __construct(SubscriberRepositoryInterface $repository)
    {
        $this->subscriberRepository = $repository;
    }

    public function handle(UserModel $userModel)
    {
        $this->subscriberRepository->create($userModel);
    }
}