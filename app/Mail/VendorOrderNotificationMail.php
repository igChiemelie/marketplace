<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorOrderNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $vendor; public $orderItems;
    public function __construct($vendor,$orderItems){ $this->vendor=$vendor; $this->orderItems=$orderItems; }
    public function build(){ return $this->subject('New Order Received')->markdown('emails.vendor_order_notification'); }
}
