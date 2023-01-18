<?php

namespace App\Domain\User;

class UserModel implements UserInterface
{
    /** @var int */
    private int $id;

    /** @var string  */
    private string $civility;

    /** @var string  */
    private string $firstName;

    /** @var string  */
    private string $lastName;

    /** @var \DateTimeInterface  */
    private \DateTimeInterface $birthDate;

    /** @var string  */
    private string $birthPlace;

    /** @var string  */
    private string $citizenship;

    /** @var string  */
    private string $maritalStatus;

    /** @var string  */
    private string $profession;

    /** @var string  */
    private string $phone;

    /** @var string  */
    private string $mobilePhone;

    /** @var string  */
    private string $email;

    /** @var string  */
    private string $password;

    /** @var \DateTimeInterface  */
    private \DateTimeInterface $creationDate;

    /** @var \DateTimeInterface  */
    private \DateTimeInterface $updateDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getCivility(): int
    {
        return $this->civility;
    }

    public function setCivility(int $civility)
    {
        $this->civility = $civility;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function getBirthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getBirthPlace(): string
    {
        return $this->birthPlace;
    }

    public function setBirthPlace(string $birthPlace)
    {
        $this->birthPlace = $birthPlace;
    }

    public function getCitizenship(): string
    {
        return $this->citizenship;
    }

    public function setCitizenship(string $citizenShip)
    {
        $this->citizenship = $citizenShip;
    }

    public function getMaritalStatus(): string
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(string $maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    public function getProfession(): string
    {
        return $this->profession;
    }

    public function setProfession(string $profession)
    {
        $this->profession = $profession;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function getMobilePhone(): string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(string $mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getCreationDate(): \DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getUpdateDate(): \DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate)
    {
        $this->updateDate = $updateDate;
    }

    public static function arrayToModel(array $data):self
    {
        // TODO Add validation
        $userModel = new self();
        $userModel->setId($data['id']);
        $userModel->setCivility($data['civility']);
        $userModel->setFirstName($data['firstName']);
        $userModel->setLastName($data['lastName']);
        $userModel->setBirthDate($data['birthDate']);
        $userModel->setBirthPlace($data['birthPlace']);
        $userModel->setCitizenship($data['citizenship']);
        $userModel->setMaritalStatus($data['maritalStatus']);
        $userModel->setProfession($data['profession']);
        $userModel->setPhone($data['phone']);
        $userModel->setMobilePhone($data['mobilePhone']);
        $userModel->setEmail($data['email']);
        $userModel->setPassword($data['password']);
        $userModel->setCreationDate($data['creationDate']);
        $userModel->setUpdateDate($data['updateDate']);

        return $userModel;
    }
}