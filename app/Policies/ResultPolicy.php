<?php

namespace App\Policies;

use App\Models\Result;
use App\Models\User;
use App\Models\Official;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ResultPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //if user is loged in, return true
        if ($user!=null) return true;

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Result  $result
     * @return mixed
     */

    // the result is public to view, if we have the id
    // ? means that the result can be viewed without logging in
    public function view(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */


    // adding new rider to the event, only with the given roles


    //megjegyzés: ez így nem teljes, a versenyszám (event) irodához és írnokhoz lesz rendelve
    //mindenki csak a hozzá rendelt eseményt kezelheti
    //ezért is van az adatbázisban a kapcsolat úgy jelölve
    public function create(User $user)
    {   
        if ($user->role=="office") return true;
        if ($user->role=="penciler") return true;
        if ($user->role=="admin") return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Result  $result
     * @return mixed
     */


    //updating the result, the penciler can only do it once, 
    //any additional change needs to go through the office


    public function update(User $user,Result $result)
    {

        if ($user->role=="admin") return true;
        
        $event=$result->start->event;
        if ($event->competition->active==false) return false;
        if ($user->role=="office" && $result->start->event->competition->office==$user->id) return true;
        $officials=Official::where("event_id",$event->id)->where("penciler",$user->id)->get();

        foreach ($officials as $official)
    
         if ($user->role=="penciler" && $result->official_id==$official->id) return true; //This works! Leave it alone...

        return false;
    }

    public function checkAfter(User $user,Result $result)
    {

        if (Auth::User()->role=="admin") return true;
        if (Auth::User()->role=="judge") return true;
        //if ($user->role="rider" && $result->start->rider_id==$user->username) return true;
        $event=$result->start->event;
        if ($event->competition->active==false) return false;
        if (Auth::User()->role=="office" && $result->start->event->competition->office==$user->id) return true;
        $officials=Official::where("event_id",$event->id)->where("penciler",$user->id)->get();
        foreach ($officials as $official) if (Auth::User()->role=="penciler" && $result->official_id==$official->id) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Result  $result
     * @return mixed
     */

    //results won't be deleted
    public function delete(User $user, Result $result)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Result  $result
     * @return mixed
     */

    //results won't be deleted
    public function restore(User $user, Result $result)
    {
        if ($user->role=="admin") return true;
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Result  $result
     * @return mixed
     */

    //result won't be deleted
    public function forceDelete(User $user, Result $result)
    {
        if ($user->role=="admin") return true;
        return false;
    }
}
