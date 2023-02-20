<?php

namespace App\Application\Utils;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Domain\Model\User\UserModel;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

trait UserUtils
{
	private VerifyEmailHelperInterface $verifyEmailHelper;
    private UserPasswordHasherInterface $passwordHasher;

	public function __construct(UserPasswordHasherInterface $passwordHasher, VerifyEmailHelperInterface $helper)
	{
		$this->verifyEmailHelper = $helper;
        $this->passwordHasher = $passwordHasher;
	}

	public function verifyEmail(UserModel $userModel, $routeName): UserModel
    {
        // Handle the user registration form and persist the new user...
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            $routeName,
            $userModel->getId(),
            $userModel->getEmail(),
            ['id' => $userModel->getId()]
        );

        $userModel->setSignatureComponents($signatureComponents);

        return $userModel;
    }

    public function hashPassword(UserModel $userModel): UserModel
    {
        $hashedPassword = $this->passwordHasher->hashPassword(
            $userModel,
            $userModel->getPassword()
        );

        $userModel->setPassword($hashedPassword);

        return $userModel;
    }
}