<?php



namespace App\Http\Controllers\ChampionshipType;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Championship;

use App\Models\Event;

use App\Models\Start;

use App\Models\Team;



class PKTeamShowJumpingController extends Controller

{

        public function show(Championship $championship)

    {       

        $events=$this->getEventsArray(json_decode($championship->events));

        if (count($events)==0)
            return view("championship.show.pkteamshowjumping",[

            "championship"=>$championship,

            "team_results"=>[],



        ]);

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

                                    "best_two"=>$event_results->sum("best_two"),

                                    "mark"=>$event_results->sum("mark"),

                                    "last_mark"=>$event_results->last()["best_two"],





                                ];



        }

        $team_results = collect($team_results);

        $team_results = $team_results->sortBy("mark")->sortBy("last_mark")->sortBy("best_two");

        







        //dd($team_results);



        return view("championship.show.pkteamshowjumping",[

            "championship"=>$championship,

            "team_results"=>$team_results,



        ]);



    }





        private function getTeamResult($event,$starts,$team){

            $teamStarts = $starts->whereIn("twoIds",$team->team_member->pluck("twoIds"));

            $teamStarts = $teamStarts->sortBy("mark");

            



            return ["event"=>$event,"starts"=>$teamStarts,"best_two"=>$teamStarts->slice(0,2)->sum("mark"),"mark"=>$teamStarts->sum("mark")];

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

