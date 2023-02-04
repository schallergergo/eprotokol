<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Start;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{
    public function loginAsUser($userId){

        if (!Auth::user()) abort(403);

        if (Auth::user()->role!=="admin") abort(403);
        //dd($userId);
        auth()->loginUsingId($userId);
        return redirect("/home");
    }

}