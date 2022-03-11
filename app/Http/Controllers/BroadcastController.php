<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use App\Models\Event;
use App\Models\Start;
use App\Http\Requests\StoreBroadcastRequest;
use App\Http\Requests\UpdateBroadcastRequest;

class BroadcastController extends Controller
{


     public function settings(Event $event){
        return view('broadcast.settings',[
            'event'=>$event,
    ]);
    }
    
    public function display(Event $event){

    if ($event->last_opened==null)  return view('broadcast.notstarted',[
        'event'=>$event
    ]);

    $start=Start::findOrFail($event->last_opened);
    $results=$start->result->sortBy("position");

    $data=request();

    if (!isset($data["nameSize"]) || !isset($data["nameSize"]) || !isset($data["pointSize"])) 

        return view('broadcast.display',[
        'nameSize'=>"display-2",
        'pointSize'=>"display-4",
        'start'=>$start,
        'results'=>$results,
    ]);

    $data= $data->validate([
        'type' => ['required', 'string'],
        'nameSize' => ['required', 'string'],
        'pointSize' => ['required', 'string']
]);
    if ($data["type"]=="full") return $this->fullDisplay($data,$start,$results);
    if ($data["type"]=="percent") return $this->percentDisplay($data,$start,$results);
    }


    private function fullDisplay($data,$start,$results){
        return view('broadcast.display',[
        'nameSize'=>$data["nameSize"],
        'pointSize'=>$data["pointSize"],
        'start'=>$start,
        'results'=>$results,
    ]);
    }
    private function percentDisplay($data,$start,$results){
        return view('broadcast.displayPercent',[
        'nameSize'=>$data["nameSize"],
        'pointSize'=>$data["pointSize"],
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
