<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }

        return false;
    }

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Role $role)
    {

    }

    public function create(User $user)
    {

    }

    public function update(User $user, Role $role)
    {

    }

    public function delete(User $user, Role $role)
    {

    }
}
