<?php 
namespace App\Message;

class PurchaseConfirmationNotification {

    private object $order; 

    public function __construct(object $order) {
        $this->order = $order;
    }

    public function getOrder()
    {
        $this->order;
    }
}