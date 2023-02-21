<?php

namespace App\Application\Controller\User;

use App\Application\Utils\MailUtils;
use App\Domain\Model\User\UserModel;
use App\Infrastructure\Repository\User\SubscriberRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use App\Application\Handler\User\SubscriberSaveHandler;
use App\Application\Handler\User\SubscriberGetHandler;
use App\Application\Utils\UserUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubscriberSignUpController extends AbstractController
{
    use UserUtils;

    public function __invoke(Request $request, MailUtils $mailUtils, MailerInterface $mailer, LoggerInterface $logger, SubscriberSaveHandler $handler, SubscriberGetHandler $subscriberGetHandler): JsonResponse
    {
        // recaptcha 6Lf8DmUkAAAAAG1xDIIS6OKtXnau2dV1hk_rHD_b
        $userModel = UserModel::arrayToModel(json_decode($request->getContent(), true));

        // Check if the e-mail already exists
        $result = $subscriberGetHandler->getByEmail($userModel->getEmail());

        if (null !== $result) {
            return $this->json(['error' => "Cette adresse e-mail existe déjà. Merci de vous connecter."], Response::HTTP_CONFLICT);
        }

        // Hash password
        $this->hashPassword($userModel);

        // Save user
        $id = $handler->handle($userModel);

        // Update model
        $userModel->setId($id);

        // Verify e-mail
        $this->verifyEmail($userModel, 'check-confirm-email');

        // Send confirmation e-mail
        $mailUtils->sendMail($userModel, $mailer, $logger, 'email/confirm_email.html.twig', 'Veuillez confirmer votre adresse e-mail');

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}