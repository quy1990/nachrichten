<?php

namespace App\Observers;

use App\Jobs\SendEmailToNewUserJob;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        dispatch(new SendEmailToNewUserJob($user->email));
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        dispatch(new SendEmailToNewUserJob($user->email));
    }
}
