<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Category\Entities\Comment;
use Modules\Category\Entities\User;

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
}
