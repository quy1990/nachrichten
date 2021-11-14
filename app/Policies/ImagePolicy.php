<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Category\Entities\Image;
use Modules\Category\Entities\User;

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
}
