<?php

namespace App\Observers;

use App\Jobs\SendEmailToSubscriberJob;
use App\Models\Video;

class VideoObserver
{
    /**
     * Handle the Video "created" event.
     *
     * @param Video $video
     * @return void
     */
    public function created(Video $video): void
    {
        $subscribedUsers = [];
        foreach ($video->user->subscribedUsers as $subscriber) {
            $subscribedUsers[] = $subscriber->email;
        }
        $subscribers = [];
        foreach ($video->category->subscribers as $subscriber) {
            $subscribers[] = $subscriber->email;
        }

        $emails = array_merge($subscribedUsers, $subscribers);

        foreach ($emails as $email) {
            dispatch(new SendEmailToSubscriberJob($email, $video));
        }
    }
}
