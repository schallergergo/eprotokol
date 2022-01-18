<?php

namespace App\Policies;

use App\Models\Official;
use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfficialPolicy
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
     * @param  \App\Models\Official  $official
     * @return mixed
     */
    public function view(User $user, Official $official)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function create(User $user, ?Event $event)
    {

        $role=$user->role;
        if ($role=="admin") return true;
        if ($role=="office" && $event->competition->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Official  $official
     * @return mixed
     */
    public function update(User $user, Official $official)
    {
  
        $role=$user->role;
        if ($role=="admin") return true;
        if ($role=="office" && $official->event->competition->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Official  $official
     * @return mixed
     */
    public function delete(User $user, Official $official)
    {
         $role=$user->role;
        if ($role=="admin") return true;
        if ($role=="office" && $official->event->competition->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Official  $official
     * @return mixed
     */
    public function restore(User $user, Official $official)
    {
         $role=$user->role;
        if ($role=="admin") return true;
        if ($role=="office" && $official->event->competition->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Official  $official
     * @return mixed
     */
    public function forceDelete(User $user, Official $official)
    {
        return true;
    }
}

