<?php
namespace App\Listeners;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Mail;

class QueueFailedListener
{
    public function handle(JobFailed $event)
    {
        $errorMessage = $event->exception->getMessage();
        $jobName = method_exists($event->job,'resolveName') ? $event->job->resolveName() : 'JobFailed';
        Mail::raw("Queued job failed: {$jobName}\n\nError: {$errorMessage}", function ($m) {
            $m->to(config('mail.from.address'))->subject('Queue Job Failed');
        });
    }
}
