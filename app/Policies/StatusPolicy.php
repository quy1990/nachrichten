<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Image\Entities\Status;
use Modules\Image\Entities\User;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return void
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Status $status
     * @return void
     */
    public function view(User $user, Status $status)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return void
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Status $status
     * @return void
     */
    public function update(User $user, Status $status)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Status $status
     * @return void
     */
    public function delete(User $user, Status $status)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Status $status
     * @return void
     */
    public function restore(User $user, Status $status)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Status $status
     * @return void
     */
    public function forceDelete(User $user, Status $status)
    {
        //
    }
}
