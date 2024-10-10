<?php







namespace App\Http\Controllers;


use App\Models\Broadcast;
use App\Models\Competition;
use App\Models\Event;
use App\Models\Start;
use App\Models\Result;
use App\Http\Requests\StoreBroadcastRequest;
use App\Http\Requests\UpdateBroadcastRequest;

class BroadcastController extends Controller
{

//this is just a comment to test the ftp thing

    public function broadcast(Event $event){

        return view("broadcast.broadcast",[

    'event'=>$event,


    ]);

    }

         public function broadcastCompetition(Competition $competition){

        return view("broadcast.broadcastCompetition",[

    'competition'=>$competition,


    ]);



    }

    public function json(Event $event){

        return json_encode($this->generateArray($event));


    }

    public function jsonCompetition(Competition $competition){

        return json_encode(["id"=>$competition->broadcast_id]);


    }


    public function serialized(Event $event){


        return serialize($this->generateArray($event));

    }

    public function generateArray(Event $event){

        $judges=[];

        if ($event->last_opened==null) 


            return ["event_name"=>$event->event_name,"last_opened"=>"","sponsor_logo"=>$event->sponsor->logo_url,"rider"=>"","horse"=>"","club"=>"","lastfilled"=>"","judges"=>$judges];


        $start=Start::find($event->last_opened);

        if ($start == null) return;

        $minimumFilled=$this->getMinimumFilled($start);

        foreach ($start->result->sortBy("position") as $result){


            $judges[]= ["position"=>$result->position,"lastMark"=>$this->getLastMarkGiven($result, $minimumFilled),"percent"=>$result->percent,"mark"=>$result->mark];



        }


        $outputArray=[



            "event_name"=>$event->event_name,
            "last_opened"=>$event->last_opened,



            "sponsor_logo"=>$event->sponsor->logo_url,



            "rider"=>$start->rider_name,



            "horse"=>$start->horse_name,



            "club"=>$start->club,



            "lastfilled"=>$minimumFilled,



            "completed"=>$start->completed,
            "mark" => $start->mark,
            "percent" =>$start->percent,



            "judges"=>$judges



            ];



        return  $outputArray;



}
    public function getCompetitonSponsors(Competition $competition)
    {
        $events = $competition->event;
        $sponsors = array();
        foreach ($events as $event){
            $url = $event->sponsor->logo_url;
            if (!in_array($url,$sponsors)) $sponsors[]=$url;
        }

        return json_encode(["sponsors"=>$sponsors]);
    }



    private function getMinimumFilled(Start $start)



        {



            $results=$start->result->sortBy("position");



            $len= count(json_decode($results->first()->assessment));







            $minimumFilled=array();



            foreach($results as $result){



                $ass=json_decode($result->assessment,true);



                $maxTemp=0;



                for ($i=0;$i<$len;$i++){







                    if($ass[$i]["mark"]!="") $maxTemp=$i;



                }



                $minimumFilled[]=$maxTemp;



            }



            $minimumFilled=min($minimumFilled);



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



