<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{
    public function user(User $user){
        return json_encode(["username"=>$user->username]);
    }
    public function contact(){

        $data = request();


        $data=$data->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string'],
            ]);
       

       


     

             $newContact=\App\Models\Contact::create([
            'name' => $data["name"],
            'email' => $data["email"],
            'longText' => $data["message"],
            'score' => 1

        ]);

    

       return json_encode(["status"=>"sent"]);

    }

}
