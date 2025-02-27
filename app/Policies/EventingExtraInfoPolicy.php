<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Eventing\EventingExtraInfo;
use App\Models\User;

class EventingExtraInfoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eventing\EventingExtraInfo  $eventingExtraInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, EventingExtraInfo $eventingExtraInfo)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eventing\EventingExtraInfo  $eventingExtraInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, EventingExtraInfo $eventingExtraInfo)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eventing\EventingExtraInfo  $eventingExtraInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, EventingExtraInfo $eventingExtraInfo)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eventing\EventingExtraInfo  $eventingExtraInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, EventingExtraInfo $eventingExtraInfo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eventing\EventingExtraInfo  $eventingExtraInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, EventingExtraInfo $eventingExtraInfo)
    {
        //
    }
}
