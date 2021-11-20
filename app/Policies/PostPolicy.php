<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

    public function view(User $user, Post $post): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return !is_null($user);
    }

    public function update(User $user, Post $post): bool
    {
        return $this->isOwner($user, $post);
    }

    public function delete(User $user, Post $post): bool
    {
        return $this->isOwner($user, $post);
    }

    private function isOwner(User $user, Post $post): bool
    {
        return $user->id == $post->created_by;
    }
}
