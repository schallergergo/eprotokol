<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Style;
use App\Models\User;

class StylePolicy
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
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Style $style)
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
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Style $style)
    {
        $role = $user->role;
        $start = $style->start;

        $event = $start->event;
        if ($role=="admin") return true;
        if ($event->competition->active==false) return false;
        if ($role=="office" && $event->competition->office==$user->id) return true;
         $officials=$event->official;
        foreach ($officials as $official)
    
         if ($role=="penciler" && $official->penciler==$user->id) return true; 

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Style $style)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Style $style)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Style $style)
    {
        //
    }
}
