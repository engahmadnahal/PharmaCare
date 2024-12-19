<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
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
        
        return $user->hasPermissionTo('Read-Payments')  ? $this->allow() : $this->deny();
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Payment $payment)
    {
        //
        return $user->hasPermissionTo('Read-Payments')  ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-Payment')  ? $this->allow() : $this->deny();

        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Payment $payment)
    {
        //
        return $user->hasPermissionTo('Update-Payment')  ? $this->allow() : $this->deny();

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Payment $payment)
    {
        //
        return $user->hasPermissionTo('Delete-Payment')  ? $this->allow() : $this->deny();

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Payment $payment)
    {
        //
    }
}
