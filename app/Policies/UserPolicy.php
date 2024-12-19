<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->hasPermissionTo('Read-Users')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, User $model)
    {
        //
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
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, User $model)
    {
        //
        if ($user->hasPermissionTo('Delete-User')) {
            if (auth('admin')->check() && $model->store_id == $user->id) {
                return $this->allow();
            } else if (auth('admin')->check()) {
                return $this->allow();
            }
        }
        return $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, User $model)
    {
        //
    }
}
