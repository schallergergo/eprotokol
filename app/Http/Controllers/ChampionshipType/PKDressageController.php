<?php

namespace App\Http\Controllers\ChampionshipType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Championship;
use App\Models\Event;
use App\Models\Start;

class PKDressageController extends Controller
{
        public function show(Championship $championship)
    {
        $events=$this->getEventsArray(json_decode($championship->events));
        $numberOfEvents=count($events);
        $startsArray=array();
        $mergedStarts= collect([]);
        $uniqueStarts;

        foreach ($events as $event){
            $starts        = $event->start;
            $startsArray[] = $starts;
            $mergedStarts  = $mergedStarts->merge($starts);
        }

        
        $uniqueStarts=$mergedStarts->unique("twoIds");
    //dd($uniqueStarts->sortBy("rider_name")); 
        $withAllStarts = array();
        $withoutAllStarts = array();
        foreach($uniqueStarts as $start){
            $foundStarts=$this->getAllStarts($startsArray, $start);
            if (count($foundStarts["starts"])==$numberOfEvents) $withAllStarts[]=$foundStarts;
            else $withoutAllStarts[]=$foundStarts;
        }
        $withAllStarts=collect($withAllStarts);
        $categories=collect($withAllStarts)->unique("category");
        $startsWithCategories=[];
        foreach($categories as  $category){
            $startsWithCategories []= $withAllStarts->where("category",$category["category"])->sortByDesc("avg");
        }

                //dd($withAllStarts);
        $withoutAllStarts=collect($withoutAllStarts)->sortByDesc("avg")->sortBy("category");

        return view("championship.show.pkdressage",[
            "championship"=>$championship,
            "startsWithCategories"=>$startsWithCategories,
            "withoutAllStarts"=>$withoutAllStarts,
        ]);

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
            
            $foundStart=$starts->where("rider_id",$start->rider_id)->where("horse_id",$start->horse_id)->where("eliminated",0);;

            if (count($foundStart)>0) $collection=$collection->merge($foundStart);
        }
        $avg=$collection->where("completed",">",0)->avg("percent") ?? 0;

        $category = $collection->first()->category;

        return collect(["category"=>$category,"starts"=>$collection,"avg"=>$avg]);
    }
}
