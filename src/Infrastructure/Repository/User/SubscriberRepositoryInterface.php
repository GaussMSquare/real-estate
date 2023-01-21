<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\Model\User\UserModel;

interface SubscriberRepositoryInterface
{
    public function create(UserModel $user): void;


}