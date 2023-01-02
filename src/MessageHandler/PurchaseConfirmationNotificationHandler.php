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
        // 1. Create a PDF contract note
        echo 'Creating a PDF contract note...<br>';

        $email = (new Email())->from('marcus@bexio.com')->to($notification->getOrder()->getBuyer()->getEmail())->subject('proof of concept')->text('What do you think?');
        $this->mailer->send($email);
    }

}