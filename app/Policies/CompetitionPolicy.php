<?php

namespace App\Policies;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompetitionPolicy
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
     * @param  \App\Models\Competition  $competition
     * @return mixed
     */
    public function view(?User $user, Competition $competition)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {    
        if ($user->role=="office") return true;
        if ($user->role=="admin") return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competition  $competition
     * @return mixed
     */
    public function update(User $user, Competition $competition)
    {
        $role=$user->role;

        if ($role=="admin") return true;
        if ($role=="office" && $competition->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competition  $competition
     * @return mixed
     */
    public function delete(User $user, Competition $competition)
    {
        $role=$user->role;
        if ($role=="admin") return true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competition  $competition
     * @return mixed
     */
    public function restore(User $user, Competition $competition)
    {
        $role=$user->role;
        if ($role=="admin") return true;
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competition  $competition
     * @return mixed
     */
    public function forceDelete(User $user, Competition $competition)
    {
        $role=$user->role;
        if ($role=="admin") return true;
        return false;
    }
}
