<?php

namespace App\MessageHandler\Event;

use App\Message\Event\OrderSavedEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;

class OrderSavedEventHandler implements MessageHandlerInterface
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function __invoke(OrderSavedEvent $event)
    {
        

        // 2. Email the contract note to the buyer

        $email = (new Email())
            ->from('marcus@bexio.com')
            ->to('marcus@bexio.com')
            ->subject('Contract note for order ' . $event)
            ->text('Here is your contract note');           

        $this->mailer->send($email);
    }
}