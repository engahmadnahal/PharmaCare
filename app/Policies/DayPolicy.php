<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Day;
use Illuminate\Auth\Access\HandlesAuthorization;

class DayPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        //
        return $user->hasPermissionTo('Read-Days')  ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Day $day)
    {
        return $user->hasPermissionTo('Read-Days')  ? $this->allow() : $this->deny();

        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        //
        return $user->hasPermissionTo('Create-Day')  ? $this->allow() : $this->deny();

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Day $day)
    {
        //
        return $user->hasPermissionTo('Update-Day')  ? $this->allow() : $this->deny();

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Day $day)
    {
        return $user->hasPermissionTo('Delete-Day')  ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Day $day)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Day $day)
    {
        //
    }
}
