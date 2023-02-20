<?php

namespace App\Application\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Component\HttpFoundation\Request;
use App\Domain\Model\User\UserModel;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
//use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Exception\TooManyLoginAttemptsAuthenticationException;

class SubscriberSignInController extends AbstractController
{
    public function __invoke(#[CurrentUser] ?UserModel $userModel/*Request $request*/, LoggerInterface $logger): JsonResponse
    {
        try {
            if (null === $userModel) {
                return $this->json(['error' => "Merci de saisir une adresse e-mail et un mot de passe"], JsonResponse::HTTP_UNAUTHORIZED);
            }

            return $this->json(['user' => $userModel->getId()], JsonResponse::HTTP_OK);
        } catch (TooManyLoginAttemptsAuthenticationException $e) {
            $logger->error(__METHOD__ . ' -- ' . $e->getMessage());
            return $this->json(['error' => "Trop de tentatives de connexion infructueuses. Merci de reessayer plus tard."], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            $logger->error(__METHOD__ . ' -- ' . $e->getMessage());
            return $this->json(['error' => "Une erreur s'est produite. Merci de vérifier votre e-mail et votre mot de passe."], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}