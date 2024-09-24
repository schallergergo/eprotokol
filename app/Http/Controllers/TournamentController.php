<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Http;


class TournamentController extends Controller
{

    public function index(){
        return view("tournament.index",["tournament"=>Tournament::all()->orderByDesc("created_at")]);
    }
    


    public function create(){
        return view("tournament.create");
    }

    public function store(){

        $data = request();
        

        $data=$data->validate([
            'name' => ['required', 'string'],
           
            ]);
        
        Tournament::create($data);
        return $redirect->back();

    }


   public function destroy (Tournament $tournament){

   }

}
