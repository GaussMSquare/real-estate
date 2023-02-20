<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\Model\User\UserModel;

interface SubscriberRepositoryInterface
{
    public function create(UserModel $user): string;
    public function get(string $id): UserModel;
    public function getByEmail(string $email): ?UserModel;
    public function update(array $fieldsToUpdate, array $where): void;

}