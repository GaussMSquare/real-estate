<?php

namespace App\Application\Handler\Country;

use App\Infrastructure\Repository\Country\GetCountryRepositoryInterface;

class GetCountryHandler
{
    private GetCountryRepositoryInterface $getCountryRepository;

    public function __construct(GetCountryRepositoryInterface $repository)
    {
        $this->getCountryRepository = $repository;
    }

    public function handle(): array
    {
        return $this->getCountryRepository->getCountries();
    }
}