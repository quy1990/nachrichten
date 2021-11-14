<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Category\Entities\Setting;
use Modules\Category\Entities\User;

class SettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \Modules\Category\Entities\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \Modules\Category\Entities\User $user
     * @param \Modules\Category\Entities\Setting $setting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Setting $setting)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \Modules\Category\Entities\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \Modules\Category\Entities\User $user
     * @param \Modules\Category\Entities\Setting $setting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Setting $setting)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \Modules\Category\Entities\User $user
     * @param \Modules\Category\Entities\Setting $setting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Setting $setting)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \Modules\Category\Entities\User $user
     * @param \Modules\Category\Entities\Setting $setting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Setting $setting)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \Modules\Category\Entities\User $user
     * @param \Modules\Category\Entities\Setting $setting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Setting $setting)
    {
        //
    }
}
