<?php

namespace App\Domain\Model\Country;

interface CountryInterface
{
    public function getId(): int;

    public function setId(int $id);

    public function getIso(): string;

    public function setIso(string $iso);

    public function getName(): string;

    public function setName(string $name);

    public function getNameFr(): string;

    public function setNameFr(string $nameFr);

    public function getNameEn(): string;

    public function setNameEn(string $nameEn);

    public function getIso3(): ?string;

    public function setIso3(?string $iso3);

    public function getNumCode(): ?int;

    public function setNumCode(?int $numCode);

    public function getPhoneCode(): int;

    public function setPhoneCode(int $phoneCode);
}