<?php

namespace App\Policies;

use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscribablePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return !is_null($user);
    }

    public function delete(User $user, Subscribe $subscribe): bool
    {
        return $user->id == $subscribe->user_id;
    }
}
