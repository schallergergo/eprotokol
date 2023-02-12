<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use App\Models\Competition;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\=Event  $=Event
     * @return mixed
     */
    public function view(?User $user, Event $event)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user,Competition $competition)
    {
        $role=$user->role;
        if ($role=="admin") return true;
        if ($role=="office" && $competition->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\=Event  $=Event
     * @return mixed
     */
    public function update(User $user, Event $event)
    {
        $role=$user->role;
        if ($role=="admin") return true;
        if ($event->competition->active==false) return false;
        $office=$event->competition->office;
        if ($role=="office" && $office==$user->id ) return true;
        
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\=Event  $=Event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        if (count($event->start)!=0) return false;
        if ($user->role=="admin") return  true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\=Event  $=Event
     * @return mixed
     */
    public function restore(User $user, Event $event)
    {
        if ($user->role=="admin") return  true;
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\=Event  $=Event
     * @return mixed
     */
    public function forceDelete(User $user, Event $event)
    {
        if (count($event->start)!=0) return false;
        dd("ketto");
        if ($user->role=="admin") return  true;
        return false;
    }
}
