<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
class PrintController extends Controller
{
    public function print(Event $event){

        if (!$event->has_startlist) return "No startlist!";

        return view("printables.startlist",["event"=>$event]);
    }
}
