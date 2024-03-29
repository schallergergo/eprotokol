<?php

namespace App\Policies;

use App\Models\Championship;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChampionshipPolicy
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
     * @param  \App\Models\Championship  $championship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Championship $championship)
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
        $role=$user->role;
        if ($role=="admin") return true;
        if ($role=="office") return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Championship  $championship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Championship $championship)
    {
        $role=$user->role;
        if ($role=="admin") return true;
        if ($role=="office" && $user->id== $championship->office) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Championship  $championship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Championship $championship)
    {
        $role=$user->role;
        if ($role=="admin") return true;
        if ($role=="office" && $user->id== $championship->office) return true;
        return false;    
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Championship  $championship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Championship $championship)
    {

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Championship  $championship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Championship $championship)
    {
        //
    }
}
