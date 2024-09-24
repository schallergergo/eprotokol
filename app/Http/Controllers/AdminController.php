<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Start;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;


class AdminController extends Controller
{

    private function isAdmin(){
        $user=Auth::user();
        if (!$user) abort(403);
        if ($user->role!=="admin") abort(403);

    }
    public function loginAsUser($userId){
        
        $this->isAdmin();
        session()->put(["admin_id"=>$userId]);
        auth()->loginUsingId($userId);
        return redirect("/home");
    }

   
public function loginBackInAsAdmin(){

        $this->isAdmin();
        auth()->loginUsingId($user_id);
        return redirect("/home");
    }

    public function notRegistered(){
        $this->isAdmin();

        $users=User::where("role","rider")->pluck("username");
        

        $starts=Start::whereNotIn("rider_id",$users)->distinct()->orderBy("rider_name")->get(["rider_id","rider_name"]);
        return view("admin.notRegistered",["starts"=>$starts]);
    }

}