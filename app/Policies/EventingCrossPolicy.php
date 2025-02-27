<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\EventingCross;
use App\Models\User;

class EventingCrossPolicy
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
     * @param  \App\Models\EventingCross  $eventingCross
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, EventingCross $eventingCross)
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
     * @param  \App\Models\EventingCross  $eventingCross
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, EventingCross $eventingCross)
    {
        $event=$eventingCross->start->event;
        $role = $user->role;
        if ($role=='admin') return true;
        if ($start->event->competition->active==false) return false;
        if ($role=='office' && $event->competition->office==$user->id) return true;
        foreach ($event->penciler as $penciler) {
            if($penciler->official == $user->id) return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EventingCross  $eventingCross
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, EventingCross $eventingCross)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EventingCross  $eventingCross
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, EventingCross $eventingCross)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EventingCross  $eventingCross
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, EventingCross $eventingCross)
    {
        //
    }
}
