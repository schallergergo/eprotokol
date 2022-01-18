<?php

namespace App\Policies;

use App\Models\Resultlog;
use App\Models\Result;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResultlogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, Result $result)
    {
        if ($user->role=="admin") return true;
        if ($user->role=="office" && $result->start->event->office==$user->id) return true;
        if ($user->role=="rider" && $user->username==$result->start->rider_id) return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resultlog  $resultlog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Resultlog $resultlog)
    {
        if ($user->role=="admin") return true;
        if ($user->role=="office" && $result->start->event->office==$user->id) return true;
        if ($user->role=="rider" && $user->username==$result->start->rider_id) return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resultlog  $resultlog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Resultlog $resultlog)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resultlog  $resultlog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Resultlog $resultlog)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resultlog  $resultlog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Resultlog $resultlog)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resultlog  $resultlog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Resultlog $resultlog)
    {
        return false;
    }
}
