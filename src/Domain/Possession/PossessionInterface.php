<?php

namespace App\Domain\Possession;

interface PossessionInterface
{
    public function getNumber(): string;

    public function getAddress(): string;

    public function getAdditionalAddress(): string;

    public function getZipCode(): string;

    public function getCity(): string;
}