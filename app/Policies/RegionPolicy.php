<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Region;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        //
        return $user->hasPermissionTo('Read-Regions')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  $user
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Region $region)
    {
        //
        return $user->hasPermissionTo('Read-Region')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        //
        return $user->hasPermissionTo('Create-Region')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Region $region)
    {
        //
        return $user->hasPermissionTo('Update-Region')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  $user
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Region $region)
    {
        //
        return $user->hasPermissionTo('Delete-Region')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  $user
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Region $region)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  $user
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Region $region)
    {
        //
    }
}
