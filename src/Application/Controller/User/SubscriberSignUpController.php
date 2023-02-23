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
use GuzzleHttp\Client;

class SubscriberSignUpController extends AbstractController
{
    use UserUtils;

    public function __invoke(Request $request, MailUtils $mailUtils, MailerInterface $mailer, LoggerInterface $logger, SubscriberSaveHandler $handler, SubscriberGetHandler $subscriberGetHandler): JsonResponse
    { 
        $userModel = UserModel::arrayToModel(json_decode($request->getContent(), true));

        // Verify recaptcha token
        $params = ['secret' => '6Lf8DmUkAAAAAG1xDIIS6OKtXnau2dV1hk_rHD_b', 'response' => $userModel->getToken()];
        $options = [CURLOPT_RETURNTRANSFER => true];
        $host = 'https://www.google.com/recaptcha/api/siteverify';
        //$client = new Client();
        //$response = $client->post($host, ['json' => $params, 'curl' => $options]);
        $curlHandle = curl_init($host);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        $curlResponse = curl_exec($curlHandle);
        $curlResponse = json_decode($curlResponse, true);

        if (false === $curlResponse['success']) {
            return $this->json(['error' => "Votre compte n'a pas pu être créé suite à une erreur."], Response::HTTP_FORBIDDEN);
        }

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