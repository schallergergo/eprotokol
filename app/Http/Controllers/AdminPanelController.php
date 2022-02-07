<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Start;

use Illuminate\Support\Facades\DB;


class AdminPanelController extends Controller
{
    public function userrider(){


$users = DB::table('users')
            ->join('starts', 'users.username', '=', 'starts.rider_id')
            ->where('users.role','=',"rider")

            ->where('users.name','<>',"starts.rider_name")
            ->distinct()->get();
    dd($users);
    }
}
