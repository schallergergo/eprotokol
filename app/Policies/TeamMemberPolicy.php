<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\TeamMember;
use App\Models\Team;
use App\Models\User;

class TeamMemberPolicy
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
        $role = $user->role;
        if ($role=="admin") return true;
        if ($role=="office" && $team->championship->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TeamMember $teamMember)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user,Team $team)
    {
        $role = $user->role;
        if ($role=="admin") return true;
        if ($role=="office" && $team->championship->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TeamMember $teamMember)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TeamMember $teamMember)
    {
        $role = $user->role;
        if ($role=="admin") return true;
        if ($role=="office" && $teamMember->team->championship->office==$user->id) return true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TeamMember $teamMember)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TeamMember $teamMember)
    {
        //
    }
}
