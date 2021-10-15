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
    public function created(Video $video)
    {
        $emails = [];
        foreach ($video->user->subscribedUsers as $subscriber) {
            $emails[] = $subscriber->email;
        }

        foreach ($video->category->subscribers as $subscriber) {
            $emails[] = $subscriber->email;
        }

        foreach ($emails as $email) {
            dispatch(new SendEmailToSubscriberJob($email, $video));
        }
    }

    /**
     * Handle the Video "updated" event.
     *
     * @param Video $video
     * @return void
     */
    public function updated(Video $video)
    {
        //
    }

    /**
     * Handle the Video "deleted" event.
     *
     * @param Video $video
     * @return void
     */
    public function deleted(Video $video)
    {
        //
    }

    /**
     * Handle the Video "restored" event.
     *
     * @param Video $video
     * @return void
     */
    public function restored(Video $video)
    {
        //
    }

    /**
     * Handle the Video "force deleted" event.
     *
     * @param Video $video
     * @return void
     */
    public function forceDeleted(Video $video)
    {
        //
    }
}
