<?php

namespace App\Jobs;

use App\Mail\SendEmailToNewUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailToNewUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailAddress;

    public function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function handle()
    {
        Mail::to($this->emailAddress)
            ->send(new SendEmailToNewUser());
    }
}
