<?php



namespace App\Http\Controllers\AJAX;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Competition;
use App\Models\DisplayStatus;
use App\Models\Start;
use App\Models\Result;

use App\Models\Event;




class CompetitionDataController extends Controller

{

     public function getCompetitionStarts(Competition $competition){

        $display_status = DisplayStatus::where('competition_id',$competition->id)->first();
       if ( !$display_status ) return [];
        $events = json_decode($display_status->automatic_events);
        $output = [];
        foreach($events as $event){
            $event_m = Event::find($event);
            if ($event_m) {
                $starts = $this->getEventStarts($event);
                $output[] = ['event_name'=>$event_m->event_name,'starts'=>$starts];
            }
        }
        return json_encode($output);
    }

    public function getEventStarts($event_id){

        $starts = Start::with('result')->select('id', 'rider_id','rider_name','horse_id','horse_name','club','category','mark','percent','collective','eliminated','updated_at')
        ->where('event_id', $event_id)
        ->where('completed','>',0)
        ->orderByDesc('updated_at')
        ->get(15);
        return $starts;
    }

    


}

