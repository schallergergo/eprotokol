<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Start;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;


class AdminController extends Controller
{
    public function loginAsUser($userId){

        
        $user=Auth::user();
        if ($user->role!=="admin") abort(403);

        session()->put(["admin_id"=>$user->id]);
        auth()->loginUsingId($userId);
        return redirect("/home");
    }

   
public function loginBackInAsAdmin(){

        if (!session()->has("admin_id")) abort(403);
        $user_id=session()->pull("admin_id");

        auth()->loginUsingId($user_id);
        return redirect("/home");
    }

}