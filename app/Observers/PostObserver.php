<?php

namespace App\Observers;

use App\Jobs\SendEmailToSubscriberJob;
use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param Post $post
     * @return void
     */
    public function created(Post $post): void
    {
        $emails = [];
        foreach ($post->user->subscribedUsers as $subscriber) {
            $emails[] = $subscriber->email;
        }

        if (!is_null($post->category)) {
            foreach ($post->category->subscribers as $subscriber) {
                $emails[] = $subscriber->email;
            }
        }

        foreach ($emails as $email) {
            dispatch(new SendEmailToSubscriberJob($email, $post));
        }
    }
}
