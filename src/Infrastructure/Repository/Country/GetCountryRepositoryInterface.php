<?php

namespace App\Infrastructure\Repository\Country;

interface GetCountryRepositoryInterface
{
    public function getCountries(): array;
}