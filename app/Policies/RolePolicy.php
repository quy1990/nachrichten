<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
