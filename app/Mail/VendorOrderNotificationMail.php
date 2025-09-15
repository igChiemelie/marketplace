<?php
namespace App\Mail;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorOrderNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $order;
    public $orderItem;

    public function __construct($vendor, Order $order, OrderItem $orderItem)
    {
        $this->vendor = $vendor;
        $this->order = $order;
        $this->orderItem = $orderItem;
    }

    public function build()
    {
        return $this->subject('New Order Received')
                    ->markdown('emails.vendor_order_notification');
    }
}