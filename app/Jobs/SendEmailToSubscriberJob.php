<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailToSubscriberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailAddress;

    public function __construct(string $emailAddress, Model $model)
    {
        $this->emailAddress = $emailAddress;
    }

    public function handle()
    {
        //Mail::to($this->emailAddress)->send(new SendEmailToSubscriber());
    }
}
