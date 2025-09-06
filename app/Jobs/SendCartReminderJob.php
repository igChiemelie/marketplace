<?php
namespace App\Jobs;

use App\Models\User;
use App\Mail\CartReminderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendCartReminderJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    public function __construct(User $user){ $this->user=$user; }
    public function handle(){ $cartItems = $this->user->cartItems()->with('product')->where('checked_out',false)->get(); if ($cartItems->isEmpty()) return; Mail::to($this->user->email)->send(new CartReminderMail($this->user,$cartItems)); }
}
