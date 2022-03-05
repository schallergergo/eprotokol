<?php

namespace App\Policies;

use App\Models\Start;
use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class StartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
      public function viewAny(User $user, User $model)
    {   
        $role=$user->role;
        if ($role=='admin') return true;
        if ($user->role=='club' && $model->club==$user->id) return true;
        return false;

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Start  $start
     * @return mixed
     */
    public function view(User $user, Start $start)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user, Event $event)
    {
        $role=$user->role;
        if ($role=='admin') return true;
        if ($role=='penciler' && $event->official->penciler==$user->id) return true;
        if ($role=='office' && $event->competition->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Start  $start
     * @return mixed
     */
    public function update(User $user, Start $start)
    {
        $role=$user->role;

        $event=$start->event;
        if ($role=='admin') return true;
        if ($start->event->competition->active==false) return false;
        if ($role=='office' && $event->competition->office==$user->id) return true;
        return false;
    }
    

    public function updateInfo(User $user, Start $start)
    {
        $role=$user->role;
        $event=$start->event;

        if ($role=='admin') return true;
        if ($event->competition->active==false) return false;
        if ($role=='office' && $event->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Start  $start
     * @return mixed
     */
    public function delete(User $user, Start $start)
    {
        $role=$user->role;

        $event=$start->event;
        if ($role=='admin') return true;
        //if ($role=='penciler' && $this->penciler($user,$start)) return true;
        if ($role=='office' && $event->competition->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Start  $start
     * @return mixed
     */
    public function restore(User $user, Start $start)
    {
        $role=$user->role;

        $event=$start->event;
        if ($role=='admin') return true;
        //if ($role=='penciler' && $this->penciler($user,$start)) return true;
        if ($role=='office' && $event->competition->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Start  $start
     * @return mixed
     */
    public function forceDelete(User $user, Start $start)
    {
        $role=$user->role;
        if ($role=='admin') return true;
    }
}
