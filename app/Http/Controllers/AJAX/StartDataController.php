<?php



namespace App\Http\Controllers\AJAX;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Start;
use App\Models\Result;

use App\Models\Event;




class StartDataController extends Controller

{

     public function getEventStarts(Event $event){

        
    $starts = Start::select('id', 'rider_name','horse_name','club','mark','percent','collective','completed','updated_at')
        ->where('event_id', $event->id)
        ->orderBy('rank')
        ->get()->map(function ($s) {
        $s->id = (string) $s->id;
        return $s;
    });
        return json_encode($starts);
    }

    public function getStartResults(Start $start){

        $starts = Start::with('result')->select('id', 'rider_name','horse_name','club','mark','percent','collective','completed','updated_at')
        ->where('id', $start->id)
        ->first(1);
        return json_encode($starts);
    }

    

    public function getRiderData(){

        

        $riders = Start::orderBy("rider_name")->select("rider_id","rider_name","club")->distinct()->get();

        return json_encode($riders);



    }

    public function getRiderAndHorseData(){

        

        $riders = Start::orderBy("rider_name")->select("rider_id","rider_name","horse_id","horse_name","club","completed")->distinct()->get();

        return json_encode($riders);



    }





    public function getHorseData($club){

        $horses = Start::where("club","LIKE","%".$club."%")->orderBy("horse_name")->select("horse_id","horse_name")->distinct()->get();

        return json_encode($horses);

    }

}

