<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use App\Models\Event;
use App\Models\Start;
use App\Models\Result;
use App\Http\Requests\StoreBroadcastRequest;
use App\Http\Requests\UpdateBroadcastRequest;

class BroadcastController extends Controller
{


     public function settings(Event $event){
        return view('broadcast.settings',[
            'event'=>$event,
    ]);
    }
    

    public function broadcast(Event $event){
        $start=Start::findOrFail($event->last_opened);
        return view("broadcast.broadcast",[
        'start'=>$start,

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
    if ($data["type"]=="lastmark") return $this->fullDisplayLastMark($data,$start,$results);
    }


    private function fullDisplay($data,$start,$results){
        return view('broadcast.display',[
        'nameSize'=>$data["nameSize"],
        'pointSize'=>$data["pointSize"],
        'start'=>$start,
        'results'=>$results,
    ]);
    }
    private function fullDisplayLastMark($data,$start,$results){
        return view('broadcast.displayLastMark',[
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
        $judges=[];
        if ($event->last_opened==null) 

            return ["rider"=>"","horse"=>"","club"=>"","lastfilled"=>"","judges"=>$judges];;

        $start=Start::find($event->last_opened);

        $minimumFilled=$this->getMinimumFilled($start);


        
        foreach ($start->result->sortBy("position") as $result){

            $judges[]=
                ["position"=>$result->position,"lastMark"=>$this->getLastMarkGiven($result, $minimumFilled),"percent"=>$result->percent];
        }
        $outputArray=["rider"=>$start->rider_name,"horse"=>$start->horse_name,"club"=>$start->club,"lastfilled"=>$minimumFilled,"judges"=>$judges];
        return  $outputArray;
}
    private function getMinimumFilled(Start $start)
        {
            $results=$start->result->sortBy("position");
            $len= count(json_decode($results->first()->assessment));
            $minimumFilled=-1;
            foreach($results as $result){
                $ass=json_decode($result->assessment,true);
                $maxTemp=0;
                for ($i=0;$i<$len;$i++){

                    if($ass[$i]["mark"]!="") $maxTemp=$i;
                }
                $minimumFilled=max($minimumFilled,$maxTemp);
            }

            return $minimumFilled;
            
        }
        private function getLastMarkGiven(Result $result, int $minimumFilled)
        {
                if ($minimumFilled==-1) return "";
                return json_decode($result->assessment,true)[$minimumFilled]["mark"];

        }


    private function getFirstRider(Event $event){
        $starts=$event->start;
        $rank=$starts->min("rank");
        $start=$starts->where("rank",$rank)->first();
        $event->last_opened=$start->id;
        $event->save();
    
    }


}
