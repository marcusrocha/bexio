<?php 
namespace App\MessageHandler;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
class PurchaseConfirmationNotificationHandler {

    public function __invoke(PurchaseConfirmationNotification $notification)
    {
        
        //TO DO

        // $email = (new Email())
        // ->from('marcus@bexio.com')
        // ->to($notification->getOrderMail())
        // ->subject('proof of concept')
        // ->text('What do you think?');        
        // $this->mailer->send($email);

    }

}