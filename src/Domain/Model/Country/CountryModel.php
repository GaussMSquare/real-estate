<?php

namespace App\Domain\Model\Country;

class CountryModel implements CountryInterface
{
    private int $id;

    private string $iso;

    private string $name;

    private string $nameFr;

    private string $nameEn;

    private ?string $iso3;

    private ?int $numCode;

    private int $phoneCode;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getIso(): string
    {
        return $this->iso;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNameFr(): string
    {
        return $this->nameFr;
    }

    public function getNameEn(): string
    {
        return $this->nameEn;
    }

    public function getIso3(): ?string
    {
        return $this->iso3;
    }

    public function getNumCode(): ?int
    {
        return $this->numCode;
    }

    public function getPhoneCode(): int
    {
        return $this->phoneCode;
    }

    public function setIso(string $iso)
    {
        $this->iso = $iso;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setNameFr(string $nameFr)
    {
        $this->nameFr = $nameFr;
    }

    public function setNameEn(string $nameEn)
    {
        $this->nameEn = $nameEn;
    }

    public function setIso3(?string $iso3)
    {
        $this->iso3 = $iso3;
    }

    public function setNumCode(?int $numCode)
    {
        $this->numCode = $numCode;
    }

    public function setPhoneCode(int $phoneCode)
    {
        $this->phoneCode = $phoneCode;
    }

    public static function arrayToModel(array $data): self
    {
        $countryModel = new self();
        $countryModel->setId($data['id']);
        $countryModel->setIso($data['iso']);
        $countryModel->setName($data['name']);
        $countryModel->setNameFr($data['nameFr']);
        $countryModel->setNameEn($data['nameEn']);
        $countryModel->setIso3($data['iso3']);
        $countryModel->setNumCode($data['numCode']);
        $countryModel->setPhoneCode($data['phoneCode']);

        return $countryModel;
    }
}