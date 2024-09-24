<?php



namespace App\Http\Controllers;



use App\Models\Event;
use App\Models\Start;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StartlistController extends Controller

{

    public function regenerate(Event $event){

    $time = $event->start_time;

    if ($time == null ) return;

    $starts = $event->start->sortBy("rank");
    $minute = $event->minutes_between_starts;
    $dateTime = Carbon::createFromFormat('H:i:s', $time);
    foreach ($starts as $start){
        // Create a Carbon instance from the time string
        $start->start_time = $time;
        $start->save();


        $dateTime->addMinutes($minute);
        // Format back to HH:mm
        $time = $dateTime->format('H:i:s');
    }

}

 public function changeNextTimes(Start $start,string $newTime){
    $event = $start->event;
    $time = $start->start_time;
        if ($time == null ) return;
    $time1 = Carbon::createFromFormat('H:i:s', $time );

    $time2 = Carbon::createFromFormat('H:i', $newTime );

    $minute = $time1->diffInMinutes($time2, false);

    $starts = $event->start->
            where("rank",">",$start->rank)->
            sortBy("rank");
    
    foreach ($starts as $start){
        // Create a Carbon instance from the time string
        $time = $start->start_time;
        $dateTime = Carbon::createFromFormat('H:i:s', $time);
        $dateTime->addMinutes($minute);
        $time = $dateTime->format('H:i:s');

        $start->start_time = $time;
        $start->save();

    }
}


 public function addStartTime(Start $start){
    $event = $start->event;
    if (!$event->has_startlist ) return;
    $time = $event->start->pluck("start_time")->max();
        
   

        $dateTime = Carbon::createFromFormat('H:i:s', $time);
        $dateTime->addMinutes($event->minutes_between_starts);
        $time = $dateTime->format('H:i:s');

        $start->start_time = $time;
        $start->save();



}


}

