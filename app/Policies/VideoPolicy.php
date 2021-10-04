<?php

namespace App\Policies;

use App\Models\Video;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Video $video): bool
    {
        return !is_null($user);
    }

    public function create(User $user): bool
    {
        return !is_null($user);
    }

    public function update(User $user, Video $video): bool
    {
        return $this->isOwner($user, $video);
    }

    private function isOwner(User $user, Video $video): bool
    {
        return true;
    }

    public function delete(User $user, Video $video): bool
    {
        return $this->isOwner($user, $video);
    }

    public function restore(User $user, Video $video): bool
    {
        return $this->isOwner($user, $video);
    }

    public function forceDelete(User $user, Video $video): bool
    {
        return $this->isOwner($user, $video);
    }
}
