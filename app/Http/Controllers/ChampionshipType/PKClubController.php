<?php

namespace App\Http\Controllers\ChampionshipType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ChampionshipType\PKClubHelperController;
use Illuminate\Http\Request;
use App\Models\Championship;
use App\Models\Event;
use App\Models\Start;

class PKClubController extends Controller
{
    public function show(Championship $championship)
    {
        $events=$this->getEventsArray(json_decode($championship->events));
        $numberOfEvents=count($events);
        $startsArray=array();
        $mergedStarts= collect([]);
        $doesNotHaveEverything=[];

        $clubs=[];

        foreach ($events as $event){
            $starts        = $event->start;
            $startsArray[] = $starts;
            $mergedStarts  = $mergedStarts->merge($starts);
        }

        
        $uniqueStarts=$mergedStarts->unique("club")->sortBy("club");
    //dd($uniqueStarts->sortBy("rider_name")); 
        
        foreach($uniqueStarts as $start){
            $clubStarts=$mergedStarts->where("club",$start->club)->sortBy("rider_name");
            $riders = $clubStarts->unique("rider_id")->pluck("rider_id");


            $riderArray = array();
            foreach($riders as $rider_id){

            $riderStarts = $clubStarts->where("rider_id",$rider_id);
            $riderArray[] = $this->getRiderArray($riderStarts);
            
            


                //dump($riderArray);
                }

                if ($this->doesTheClubHaveEverything($riderArray))
                {
                    $helper = new PKClubHelperController($riderArray);
                    $helper->calculateScore(0,0);
                    $score = $helper->getMaxPoint();
                    $pointArray = $helper->getPointArray();
                    $pkscore = $helper->getPk1Score();
                    if (count($pointArray)==0) $doesNotHaveEverything[] = ["club"=>$start->club,"riderArray"=>$riderArray,"score"=>0];
                    else $clubs[]=["club"=>$start->club,"riderArray"=>$riderArray,"pointArray"=>$pointArray,"score"=>$score,"pkscore"=>$pkscore];
                    //dump($clubs);
                }  

                else{
                    $doesNotHaveEverything[] = ["club"=>$start->club,"riderArray"=>$riderArray,"score"=>0];

                }

        }
        $clubs = collect($clubs);
        $clubs = $clubs->sortByDesc("pkscore")->sortByDesc("score");

        //dd($clubs);

     
        return view("championship.show.pkclub",[
            "championship"=>$championship,
            "clubs"=>$clubs,
            "doesNotHaveEverything"=>$doesNotHaveEverything,
        ]);

    }
        private function getRiderArray($riderStarts){

            $riderArray = array(null,null,null,null);
            $programIdArray=array([35,36],[2],[4,5,7,8,10,11],[69]);
            foreach($riderStarts as $start){
                $program_id = $start->event->program->id;
                for($i=0;$i<4;$i++){
                    if(in_array($program_id, $programIdArray[$i])) $riderArray[$i] = $this->getBetterStart($riderArray[$i],$start);
                }
                
            }
            //dump($riderArray);
            return ["name"=>$riderStarts->first()->rider_name,"data"=>$riderArray];

        }

        private function getBetterStart(?Start $arrayStart, Start $newStart){
            if ($arrayStart==null) return $newStart;
            if ($arrayStart->percent>$newStart->percent) return $arrayStart;
            return $newStart;
            
        }
        private function doesTheClubHaveEverything($riderArray){
            $checkArray=[0,0,0,0];
            foreach($riderArray as $rider){
                for($i=0;$i<4;$i++){
                    if ($rider["data"][$i]!=null) $checkArray[$i]=1;
                }
            }
            return array_sum($checkArray)==4;
        }

        private function getEventsArray (array $events){
        $outputArray=array();
        foreach ($events as $event){
            $foundEvent = Event::find($event);
            if ($foundEvent!= null) $outputArray[]=$foundEvent;
        }
        return $outputArray;
    }


    private function getAllStarts(array $startsArray, Start $start){

        $outputArray = array();
        $collection=collect([]);
        foreach ($startsArray as $starts){
            
            $foundStart=$starts->where("rider_id",$start->rider_id)->where("horse_id",$start->horse_id);

            if (count($foundStart)>0) $collection=$collection->merge($foundStart);
        }
        $avg=$collection->where("completed",">",0)->avg("percent") ?? 0;

        $category = $collection->first()->category;

        return collect(["category"=>$category,"starts"=>$collection,"avg"=>$avg]);
    }
}
