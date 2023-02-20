<?php

declare(strict_types=1);

namespace App\Application\Controller\User;

use App\Application\Handler\User\SubscriberUpdateHandler;
use App\Infrastructure\Repository\User\SubscriberRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use App\Application\Utils\UserUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Application\Utils\MailUtils;
use Symfony\Component\Mailer\MailerInterface;

class UserCheckController extends AbstractController
{
    private SubscriberRepositoryInterface $subscriberRepository;
    private VerifyEmailHelperInterface $verifyEmailHelper;
    private SubscriberUpdateHandler $handler;

    public function __construct(SubscriberRepositoryInterface $repository, VerifyEmailHelperInterface $helper, SubscriberUpdateHandler $handler)
    {
        $this->subscriberRepository = $repository;
        $this->verifyEmailHelper = $helper;
        $this->handler = $handler;
    }

    /**
     * @Route("/user/check-confirm-email", name="check-confirm-email")
     */
    public function checkConfirmEmail(Request $request, LoggerInterface $logger, MailUtils $mailUtils, MailerInterface $mailer): JsonResponse
    {
        $id = $request->get('id');

        // Verify the user id exists and is not null
        if (null === $id) {
            return $this->json(['error' => "Cet identifiant n'existe pas"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $userModel = $this->subscriberRepository->get($id);

        // Ensure the user exists in persistence
        if (null === $userModel) {
            return $this->json(['error' => "Cet utilisateur n'existe pas"], Response::HTTP_NOT_FOUND);
        }

        // Do not get the User's Id or Email Address from the Request object
        try {
            $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), (string) $userModel->getId(), $userModel->getEmail());

            $userModel->setIsVerified(true);

            // Update user
            $this->handler->update(['is_verified' => $userModel->getIsVerified()], ['id' => $userModel->getId()]);

            // Send activation e-mail
            $mailUtils->sendMail($userModel, $mailer, $logger, 'email/creation_compte.html.twig', 'Activation de votre compte');

            return $this->json(null, Response::HTTP_NO_CONTENT);
        } catch (VerifyEmailExceptionInterface $e) {
            $logger->error(__METHOD__ . ' -- ' . $e->getReason());

            // Redirect to sign-in
            return $this->json(['error' => "Une erreur s'est produite lors de la confirmation de l'adresse e-mail"], Response::HTTP_NOT_FOUND);
        }
    }
}