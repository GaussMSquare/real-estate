<?php

namespace App\Application\Handler\MaritalStatus;

use App\Infrastructure\Repository\MaritalStatus\GetMaritalStatusRepositoryInterface;

class GetMaritalStatusHandler
{
    private GetMaritalStatusRepositoryInterface $getMaritalStatusRepository;

    public function __construct(GetMaritalStatusRepositoryInterface $repository)
    {
        $this->getMaritalStatusRepository = $repository;
    }

    public function handle(): array
    {
        return $this->getMaritalStatusRepository->getMaritalStatuses();
    }

}