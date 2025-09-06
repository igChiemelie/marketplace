<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CartReminderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user; public $cartItems;
    public function __construct($user,$cartItems){ $this->user=$user; $this->cartItems=$cartItems; }
    public function build(){ return $this->subject('You left items in your cart')->markdown('emails.cart_reminder'); }
}
