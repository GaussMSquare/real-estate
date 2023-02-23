<?php

namespace App\Application\Utils;

use App\Domain\Model\User\UserModel;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class MailUtils
{
    private string $emailFrom;

    public function __construct(#[Autowire('%app.email_from%')] string $emailFrom)
    {
        $this->emailFrom = $emailFrom;
    }

    public function sendMail(UserModel $userModel, MailerInterface $mailer, LoggerInterface $logger, $template, $subject): void
    {
        $email = new TemplatedEmail();
        $email->to($userModel->getEmail());
        $email->from(new Address($this->emailFrom, 'Mercure SaaS'));
        $email->subject($subject);
        $email->htmlTemplate($template);
        $email->context(['signedUrl' => $userModel->getSignatureComponents()->getSignedUrl()]);

        try {
            $mailer->send($email);        
        } catch (TransportExceptionInterface $e) {
            $logger->error('Cannot send mail : ' . $e->getMessage() . PHP_EOL . $e->getDebug());
        }
    }
}