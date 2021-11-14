<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Image\Entities\Tag;
use Modules\User\Entities\User;

class TagPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Tag $tag): bool
    {
        return !is_null($user);
    }

    public function create(User $user): bool
    {
        return !is_null($user);
    }

    public function update(User $user, Tag $tag): bool
    {
        return !is_null($user);
    }

    public function delete(User $user, Tag $tag): bool
    {
        return !is_null($user);
    }
}
