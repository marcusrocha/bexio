<?php 
namespace App\Message\Event;

class OrderSavedEvent {   

    public function __construct(private string $order) {
        
    }

    public function getOrderMail()
    {
       return $this->order;
    }
}