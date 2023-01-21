<?php

namespace App\Application\Handler\Civility;

use App\Infrastructure\Repository\Civility\GetCivilityRepositoryInterface;

class GetCivilityHandler
{
    private GetCivilityRepositoryInterface $getCivilityRepository;

    public function __construct(GetCivilityRepositoryInterface $repository)
    {
        $this->getCivilityRepository = $repository;
    }

    public function handle(): array
    {
        return $this->getCivilityRepository->getCivilities();
    }
}