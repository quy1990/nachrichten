<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Category\Entities\Menu;
use Modules\Image\Entities\User;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \Modules\Image\Entities\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \Modules\Image\Entities\User $user
     * @param \Modules\Category\Entities\Menu $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Menu $menu)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \Modules\Image\Entities\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \Modules\Image\Entities\User $user
     * @param \Modules\Category\Entities\Menu $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Menu $menu)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \Modules\Image\Entities\User $user
     * @param \Modules\Category\Entities\Menu $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Menu $menu)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \Modules\Image\Entities\User $user
     * @param \Modules\Category\Entities\Menu $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Menu $menu)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \Modules\Image\Entities\User $user
     * @param \Modules\Category\Entities\Menu $menu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Menu $menu)
    {
        //
    }
}
