<?php 
namespace App\Message;

class PurchaseConfirmationNotification {   

    public function __construct(private string $order) {
        
    }

    public function getOrderMail()
    {
       return $this->order;
    }
}