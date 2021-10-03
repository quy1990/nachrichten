<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Comment $comment): bool
    {
        return !is_null($user);
    }

    public function create(User $user): bool
    {
        return !is_null($user);
    }

    public function update(User $user, Comment $comment): bool
    {
        return $this->isOwner($user, $comment);
    }

    private function isOwner(User $user, Comment $comment): bool
    {
        return true;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $this->isOwner($user, $comment);
    }

    public function restore(User $user, Comment $comment): bool
    {
        return $this->isOwner($user, $comment);
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        return $this->isOwner($user, $comment);
    }
}
