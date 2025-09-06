<?php
namespace App\Notifications;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VendorApproved extends Notification
{
    protected $vendor;
    public function __construct($vendor){ $this->vendor=$vendor; }
    public function via($notifiable){ return ['mail']; }
    public function toMail($notifiable){ return (new MailMessage)->subject('Your vendor account is approved')->line('Your vendor account has been approved.')->action('Login', url('/login')); }
}
