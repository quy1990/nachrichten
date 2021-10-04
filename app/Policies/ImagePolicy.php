<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Image $image): bool
    {
        return !is_null($user);
    }

    public function create(User $user): bool
    {
        return !is_null($user);
    }

    public function update(User $user, Image $image): bool
    {
        return !is_null($user);
    }

    public function delete(User $user, Image $image): bool
    {
        return !is_null($user);
    }

    public function restore(User $user, Image $image): bool
    {
        return !is_null($user);
    }

    public function forceDelete(User $user, Image $image): bool
    {
        return !is_null($user);
    }
}
