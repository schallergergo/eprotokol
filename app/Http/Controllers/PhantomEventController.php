<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Start;

class PhantomEventController extends Controller
{
    public function show(Event $event)
    {   $results=array();
        $starts = $event->start;
        foreach ($starts as $start){
            $results[]=$this->getAvarage($start);

        }
        rsort($results);
        return view("event.phantom",["results"=>$results,"event"=>$event]);
    }


    private function getAvarage(Start $start){
        $ownStarts=Start::where("rider_id",$start->rider_id)
                        ->where("horse_id",$start->horse_id)
                        ->where("completed",1)->get();

        return ["percent"=>$ownStarts->average("percent"),"rider"=>$start->rider_name,"horse"=>$start->horse_name];
    }
}
