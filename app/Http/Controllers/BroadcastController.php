<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use App\Models\Event;
use App\Models\Start;
use App\Http\Requests\StoreBroadcastRequest;
use App\Http\Requests\UpdateBroadcastRequest;

class BroadcastController extends Controller
{
    public function display(Event $event){
    if ($event->last_opened==null)  return ;

    $start=Start::findOrFail($event->last_opened);
    $results=$start->result->sortBy("position");


    return view('broadcast.display',[
        'start'=>$start,
        'results'=>$results,

    ]);
    }

    public function json(Event $event){
        return json_encode($this->generateArray($event));
    }
    public function serialized(Event $event){

        return serialize($this->generateArray($event));
    }

    public function generateArray(Event $event){
       // if ($event->last_opened==null) $this->getFirstRider($event);
        if ($event->last_opened==null) return [];
        $start=Start::find($event->last_opened);
        $outputArray=array();
        $outputArray[]=["rider"=>$start->rider_name];
        $outputArray[]=["horse"=>$start->horse_name];
        $outputArray[]=["club"=>$start->club];

        $judges=[];
        foreach ($start->result->sortBy("position") as $result){
            $judges[]=[$result->position=>$result->percent];
        }
        $outputArray[]=["judges"=>$judges];    
        return  $outputArray;
}


    private function getFirstRider(Event $event){
        $starts=$event->start;
        $rank=$starts->min("rank");
        $start=$starts->where("rank",$rank)->first();
        $event->last_opened=$start->id;
        $event->save();
    
    }
}
