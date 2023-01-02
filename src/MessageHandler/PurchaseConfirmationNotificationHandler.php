<?php 
namespace App\MessageHandler;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Mime\Email;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mailer\MailerInterface;

#[AsMessageHandler]
class PurchaseConfirmationNotificationHandler {

    public function __construct (private MailerInterface $mailer) {

    }

    public function __invoke(PurchaseConfirmationNotification $notification)
    {
        $email = (new Email())
        ->from('marcus@bexio.com')
        ->to($notification->getOrderMail())
        ->subject('proof of concept')
        ->text('What do you think?');
     

        $this->mailer->send($email);
    }

}