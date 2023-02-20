<?php

namespace App\Domain\Model\User;

interface UserInterface
{
    public function getId(): int;

    public function setId(int $id);

    public function getCivility(): int;

    public function setCivility(int $civility);

    public function getFirstName(): string;

    public function setFirstName(string $firstName);

    public function getLastName(): string;

    public function setLastName(string $lastName);

    public function getBirthDate(): \DateTimeInterface;

    public function setBirthDate(\DateTimeInterface $birthDate);

    public function getBirthPlace(): string;

    public function setBirthPlace(string $birthPlace);

    public function getCitizenship(): string;

    public function setCitizenship(string $citizenShip);

    public function getMaritalStatus(): string;

    public function setMaritalStatus(string $maritalStatus);

    public function getProfession(): string;

    public function setProfession(string $profession);

    public function getPhone(): string;

    public function setPhone(string $phone);

    public function getMobilePhone(): string;

    public function setMobilePhone(string $mobilePhone);

    public function getEmail(): string;

    public function setEmail(string $email);

    public function getCreationDate(): \DateTimeInterface;

    public function setCreationDate(\DateTimeInterface $creationDate);

    public function getUpdateDate(): \DateTimeInterface;

    public function setUpdateDate(\DateTimeInterface $updateDate);

    public function getRoles(): array;

    public function setRoles(array $roles): self;
}