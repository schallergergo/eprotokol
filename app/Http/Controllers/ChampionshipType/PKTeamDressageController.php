<?php

namespace App\Http\Controllers\ChampionshipType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Championship;
use App\Models\Competition;
use App\Models\Event;
use App\Models\Start;
use App\Models\Team;
class PKTeamDressageController extends Controller
{
    public function show(Championship $championship)
    {       
        $events=collect($this->getEventsArray(json_decode($championship->events)));
        $numberOfEvents=count($events);
        $team_results = array();
        $uniqueStarts;
        $teams = $championship->team;
        $competitions = array();


        foreach ($events as $event) $competitions[] = $event->competition;

        $competitions = competition::whereIn("id",$events->pluck("competition_id"))->get();

        foreach ($teams as $team){
            $competition_results=array();
            foreach($competitions as $competition){
                
                $competitionEvents = $events->where("competition_id",$competition->id);
                $starts = collect();
            foreach($competitionEvents as $event) 
                {
                     $starts = $starts->merge($event->start->where("eliminated",0));
                   
                    
                }

                    $competition_result = $this->getTeamResult($competition,$starts,$team);
                    $competition_results[] = $competition_result;

            }

                $competition_results = collect($competition_results);

                $team_results[] = [
                                    "team"=>$team,
                                    "competition_results"=>$competition_results,

                                    "best_two"=>$competition_results->avg("best_two"),
                                    "average"=>$competition_results->avg("average"),
                                    "last_average"=>$competition_results->last()["best_two"],


                                ];
     }

        $team_results = collect($team_results);
        $team_results = $team_results->sortByDesc("average")->sortBy("last_average")->sortByDesc("best_two");
        





        return view("championship.show.pkteamdressage",[
            "championship"=>$championship,
            "team_results"=>$team_results,

        ]);

    }


        private function getTeamResult($competition,$starts,$team){
            $teamStarts = $starts->whereIn("twoIds",$team->team_member->pluck("twoIds"));
            $teamStarts = $teamStarts->sortByDesc("percent");
            

            return ["competition"=>$competition,"starts"=>$teamStarts,"best_two"=>$teamStarts->slice(0,2)->avg("percent"),"average"=>$teamStarts->avg("percent")];
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
