<?php

namespace App\Infrastructure\Repository;

use App\Domain\User\UserModel;

interface SubscriberRepositoryInterface
{
    public function create(UserModel $user): void;


}