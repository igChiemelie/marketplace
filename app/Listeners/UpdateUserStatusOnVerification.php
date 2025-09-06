<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserStatusOnVerification
{
    public function handle(Verified $event)
    {
        $user = $event->user;
        $user->status = 'active';
        $user->save();
    }
}