<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Faq;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
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
        return $this->allow();
        // return $user->hasPermissionTo('Read-FAQs')
        //     ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  $user
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Faq $faq)
    {
        //
        return $user->hasPermissionTo('Read-FAQs')
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
        return $user->hasPermissionTo('Create-FAQ')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Faq $faq)
    {
        //
        if (auth('admin')->check())
            return $user->hasPermissionTo('Update-FAQ')
                ? $this->allow() : $this->deny();
        else return $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  $user
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Faq $faq)
    {
        //
        if (auth('admin')->check())
            return $user->hasPermissionTo('Delete-FAQ')
                ? $this->allow() : $this->deny();
        else return $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  $user
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Faq $faq)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  $user
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Faq $faq)
    {
        //
    }
}
