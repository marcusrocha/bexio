<?php

namespace App\Controller;

use App\Message\Command\SaveOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class StockTransactionController extends AbstractController{

    #[Route('/api/buy', name: 'buy-stock')]
    public function buy(MessageBusInterface $bus): Response
    {     

        // 1. Dispatch confirmation message
        $bus->dispatch(new SaveOrder());

        // 2. Display confirmation to the user
        return $this->render('stocks/examples.html.twig');
    }
}