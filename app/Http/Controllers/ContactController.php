<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Http;


class ContactController extends Controller
{
    public function create(){
        return view("contact.contact");
    }

    public function store(){

        $data = request();
        

        $data=$data->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string'],
            'g-recaptcha-response' => ['required','string']
            ]);
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=6LcBE-4eAAAAABp-quBbxY24jDREguNQr-o_jUBd&response='.$data["g-recaptcha-response"]);
        $response=json_decode($response);


       


        if ($response->success) {

             $newContact=\App\Models\Contact::create([
            'name' => $data["name"],
            'email' => $data["email"],
            'message' => $data["message"],
            'score' => $response->success
        ]);
            $this->sendMail($data);
        }

        else return redirect()->back()->with("fail",Lang::get("Error! Your message could not be sent!"));

       return redirect()->back()->with("success",Lang::get("Your message has been sent!"));

    }


    private function sendMail(array $message){


            Mail::to("info@eprotokol.hu")->send(new ContactMail($message));
        }

}
