<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\City;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
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
        return $user->hasPermissionTo('Read-Cities')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, City $city)
    {
        //
        return $user->hasPermissionTo('Read-City')
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
        return $user->hasPermissionTo('Create-City')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, City $city)
    {
        //
        return $user->hasPermissionTo('Update-City')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, City $city)
    {
        //
        return $user->hasPermissionTo('Delete-City')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, City $city)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, City $city)
    {
        //
    }
}
