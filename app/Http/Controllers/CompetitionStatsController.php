<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompetitionStatsController extends Controller
{

    public function show(Competition $competition){

        return view("competition.stats.show",["competition"=>$competition]);
    
    }


    public function showHorseStartNumber(Competition $competition){



$result = DB::table('starts')
    ->select('starts.horse_name', 'starts.horse_id',DB::raw('count(starts.horse_name) as horse_count'))
    ->join('events', 'events.id', '=', 'starts.event_id')
    ->join('competitions', 'competitions.id', '=', 'events.competition_id')
    ->where('competitions.id', $competition->id)
    ->groupBy('starts.horse_name','starts.horse_id')
    ->orderByDesc("horse_count")
    ->get();
    return view("competition.stats.horses",

            [
                "competition"=>$competition,
                "results"=>$result

            ]);
    }



    public function showHorseStarts(Competition $competition, string $horse){

            $result = DB::table('starts')
    ->select('starts.rider_id','starts.rider_name','starts.horse_name', 'starts.horse_id',"events.event_name")
    ->join('events', 'events.id', '=', 'starts.event_id')
    ->join('competitions', 'competitions.id', '=', 'events.competition_id')
    ->where('competitions.id', $competition->id)
    ->where('starts.horse_id',$horse)
    ->orderBy("event_name")
    ->get();


    return view("competition.stats.horsestarts",

            [
                "competition"=>$competition,
                "results"=>$result


            ]);
    
    }



    public function showRiderStartNumber(Competition $competition){



$result = DB::table('starts')
    ->select('starts.rider_name', 'starts.rider_id',DB::raw('count(starts.rider_name) as rider_count'))
    ->join('events', 'events.id', '=', 'starts.event_id')
    ->join('competitions', 'competitions.id', '=', 'events.competition_id')
    ->where('competitions.id', $competition->id)
    ->groupBy('starts.rider_name','starts.rider_id')
    ->orderByDesc("rider_count")
    ->get();
    return view("competition.stats.riders",

            [
                "competition"=>$competition,
                "results"=>$result

            ]);
    }



    public function showRiderStarts(Competition $competition, string $rider){

            $result = DB::table('starts')
    ->select('starts.rider_id','starts.rider_name','starts.horse_name', 'starts.horse_id',"events.event_name")
    ->join('events', 'events.id', '=', 'starts.event_id')
    ->join('competitions', 'competitions.id', '=', 'events.competition_id')
    ->where('competitions.id', $competition->id)
    ->where('starts.rider_id',$rider)
    ->orderBy("event_name")
    ->get();


    return view("competition.stats.horsestarts",

            [
                "competition"=>$competition,
                "results"=>$result


            ]);
    
    }
    
}