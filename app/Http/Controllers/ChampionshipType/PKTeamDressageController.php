<?php

namespace App\Http\Controllers\ChampionshipType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Championship;
use App\Models\Event;
use App\Models\Start;
use App\Models\Team;
class PKTeamDressageController extends Controller
{
    public function show(Championship $championship)
    {       
        $events=$this->getEventsArray(json_decode($championship->events));
        $numberOfEvents=count($events);
        $team_results = array();
        $uniqueStarts;
        $teams = $championship->team;

        foreach ($teams as $team){
                $event_results=array();
            foreach($events as $event) 
                {
                    $starts        = $event->start->where("eliminated",0);
                    $event_result = $this->getTeamResult($event,$starts,$team);
                    $event_results[] = $event_result;
                    
                }

                $event_results = collect($event_results);
                $team_results[] = [
                                    "team"=>$team,
                                    "event_results"=>$event_results,
                                    "best_two"=>$event_results->avg("best_two"),
                                    "average"=>$event_results->avg("average"),
                                    "last_average"=>$event_results->last()["best_two"],


                                ];

        }
        $team_results = collect($team_results);
        $team_results = $team_results->sortByDesc("average")->sortBy("last_average")->sortByDesc("best_two");
        



        //dd($team_results);

        return view("championship.show.pkteamdressage",[
            "championship"=>$championship,
            "team_results"=>$team_results,

        ]);

    }


        private function getTeamResult($event,$starts,$team){
            $teamStarts = $starts->whereIn("twoIds",$team->team_member->pluck("twoIds"));
            $teamStarts = $teamStarts->sortByDesc("percent");
            

            return ["event"=>$event,"starts"=>$teamStarts,"best_two"=>$teamStarts->slice(0,2)->avg("percent"),"average"=>$teamStarts->avg("percent")];
        }

        private function getEventsArray (array $events){
        $outputArray=array();
        foreach ($events as $event){
            $foundEvent = Event::find($event);
            if ($foundEvent!= null) $outputArray[]=$foundEvent;
        }
        return $outputArray;
    }



}
