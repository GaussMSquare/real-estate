<?php

declare(strict_types=1);

namespace App\Application\Handler\User;

use App\Domain\Model\User\UserModel;
use App\Infrastructure\Repository\User\SubscriberRepositoryInterface;

class SubscriberUpdateHandler
{
    private SubscriberRepositoryInterface $subscriberRepository;

    public function __construct(SubscriberRepositoryInterface $repository)
    {
        $this->subscriberRepository = $repository;
    }

    public function update(array $fieldsToUpdate, array $where): void
    {
        $this->subscriberRepository->update($fieldsToUpdate, $where);
    }
}