<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin() || $user->isMod()) {
            return true;
        }
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Image $image): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return !is_null($user);
    }

    public function update(User $user, Image $image): bool
    {
        return $this->isOwner($user, $image);
    }

    public function delete(User $user, Image $image): bool
    {
        return $this->isOwner($user, $image);
    }

    private function isOwner(User $user, Image $image): bool
    {
        return $user->id == $image->user_id;
    }
}
