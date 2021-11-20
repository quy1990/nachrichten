<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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

    public function view(User $user, Comment $comment): bool
    {
        return true;
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
        return $user->id == $comment->user_id;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $this->isOwner($user, $comment);
    }
}
