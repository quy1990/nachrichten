<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\User;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Category $category): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return !is_null($user);
    }

    public function update(User $user, Category $category): bool
    {
        return $this->isOwner($user, $category);
    }

    private function isOwner(User $user, Category $category): bool
    {
        return true;
    }

    public function delete(User $user, Category $category): bool
    {
        return $this->isOwner($user, $category);
    }
}
