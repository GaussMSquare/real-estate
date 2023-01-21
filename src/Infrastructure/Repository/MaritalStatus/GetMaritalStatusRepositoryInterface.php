<?php

namespace App\Infrastructure\Repository\MaritalStatus;

interface GetMaritalStatusRepositoryInterface
{
    public function getMaritalStatuses(): array;
}