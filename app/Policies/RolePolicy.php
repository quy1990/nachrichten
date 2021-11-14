<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Image\Entities\Role;
use Modules\User\Entities\User;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Role $role): bool
    {
        return !is_null($user);
    }

    public function create(User $user): bool
    {
        return !is_null($user);
    }

    public function update(User $user, Role $role): bool
    {
        return !is_null($user);
    }

    public function delete(User $user, Role $role): bool
    {
        return !is_null($user);
    }
}
