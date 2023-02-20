<?php

namespace App\Domain\Model\User;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use SymfonyCasts\Bundle\VerifyEmail\Model\VerifyEmailSignatureComponents;
use Symfony\Component\Security\Core\User\UserInterface;
//use Assert\Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subscriber")
 */
class UserModel implements UserInterface, PasswordAuthenticatedUserInterface
{
    /** 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int 
     */
    private ?int $id = null;

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

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     */
    private string $email;

    /** @var string  */
    private ?string $password = null;

    /** @var \DateTimeInterface  */
    private \DateTimeInterface $creationDate;

    /** @var \DateTimeInterface  */
    private \DateTimeInterface $updateDate;

    /** @var array */
    private array $roles = [];

    private VerifyEmailSignatureComponents $signatureComponents;

    private bool $isVerified = false;

    public function getId(): ?int
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
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

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSignatureComponents(): VerifyEmailSignatureComponents
    {
        return $this->signatureComponents;
    }

    public function setSignatureComponents(VerifyEmailSignatureComponents $signatureComponents): self
    {
        $this->signatureComponents = $signatureComponents;
        return $this;
    }

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /**
     * Returning a salt is only needed if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;
        return $this;
    }

    public static function arrayToModel(array $data):self
    {
        $userModel = new self();

        // TODO Add validation
        /*Assert::lazy()
            ->tryAll()
            ->that($data)->keyExists('type', 'The type should be a provided', 'type')
            ->that($data)->keyExists('duration', 'The duration should be a provided', 'duration')
            ->that($data)->keyExists('blob', 'The blob should be a provided', 'content')
            ->verifyNow();*/

        if (isset($data['id']))
            $userModel->setId($data['id']);

        if (isset($data['civility']))
            $userModel->setCivility($data['civility']);

        if (isset($data['firstName']))
            $userModel->setFirstName($data['firstName']);

        if (isset($data['lastName']))
            $userModel->setLastName($data['lastName']);

        if (isset($data['birthDate']))
            $userModel->setBirthDate($data['birthDate']);

        if (isset($data['birthPlace']))
            $userModel->setBirthPlace($data['birthPlace']);

        if (isset($data['citizenship']))
            $userModel->setCitizenship($data['citizenship']);

        if (isset($data['maritalStatus']))
            $userModel->setCitizenship($data['maritalStatus']);

        if (isset($data['profession']))
            $userModel->setProfession($data['profession']);

        if (isset($data['phone']))
            $userModel->setPhone($data['phone']);

        if (isset($data['mobilePhone']))
            $userModel->setMobilePhone($data['mobilePhone']);

        if ($data['email'])
            $userModel->setEmail($data['email']);

        if (isset($data['password']))
            $userModel->setPassword($data['password']);

        return $userModel;
    }
}