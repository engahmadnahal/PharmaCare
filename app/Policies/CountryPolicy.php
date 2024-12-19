<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Country;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
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
        return $user->hasPermissionTo('Read-Countries')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  $user
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Country $country)
    {
        //
        return $user->hasPermissionTo('Read-Countries')
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
        return $user->hasPermissionTo('Create-Country')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Country $country)
    {
        //
        return $user->hasPermissionTo('Update-Country')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  $user
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Country $country)
    {
        //
        return $user->hasPermissionTo('Delete-Country')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  $user
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Country $country)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  $user
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Country $country)
    {
        //
    }
}
