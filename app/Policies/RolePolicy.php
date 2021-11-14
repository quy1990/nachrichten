<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Category\Entities\Role;
use Modules\Category\Entities\User;

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
