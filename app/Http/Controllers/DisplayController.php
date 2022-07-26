<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Event;
use App\Models\Start;
use App\Models\Result;
class DisplayController extends Controller
{
   public function settings(Event $event){
        return view('display.settings',[
            'event'=>$event,
    ]);
    }


    public function vilagos(Competition $competition){
        return view("display.vilagos",[
        'competition'=>$competition,

    ]);
    }
    public function tatter(Competition $competition){
        return view("display.tatter",[
        'competition'=>$competition

    ]);
    }

    public function compsetting(Competition $competition){
                return view("display.compsetting",[
        'competition'=>$competition,

    ]);
    }


    public function storeCompsetting(Competition $competition){
        $data=request();
        $data= $data->validate([
        'events' => []
        ]);
        if (isset($data["events"])) $competition->active_event=json_encode($data["events"]);
        else $competition->active_event=json_encode([]);
        $competition->save();
        return redirect()->back();
    }
    public function display(Event $event){

    if ($event->last_opened==null)  return view('display.notstarted',[
        'event'=>$event
    ]);

    $start=Start::findOrFail($event->last_opened);
    $results=$start->result->sortBy("position");

    $data=request();

    if (!isset($data["nameSize"]) || !isset($data["nameSize"]) || !isset($data["pointSize"])) 

        return view('display.display',[
        'nameSize'=>"display-2",
        'pointSize'=>"display-4",
        'start'=>$start,
        'results'=>$results,
    ]);

    $data= $data->validate([
        'type' => ['required', 'string'],
        'nameSize' => ['required', 'string'],
        'pointSize' => ['required', 'string']
]);
    if ($data["type"]=="full") return $this->fullDisplay($data,$start,$results);
    if ($data["type"]=="percent") return $this->percentDisplay($data,$start,$results);
    if ($data["type"]=="lastmark") return $this->fullDisplayLastMark($data,$start,$results);
    }


    private function fullDisplay($data,$start,$results){
        return view('display.display',[
        'nameSize'=>$data["nameSize"],
        'pointSize'=>$data["pointSize"],
        'start'=>$start,
        'results'=>$results,
    ]);
    }
    private function fullDisplayLastMark($data,$start,$results){
        return view('display.displayLastMark',[
        'nameSize'=>$data["nameSize"],
        'pointSize'=>$data["pointSize"],
        'start'=>$start,
        'results'=>$results,
    ]);
    }
    private function percentDisplay($data,$start,$results){
        return view('display.displayPercent',[
        'nameSize'=>$data["nameSize"],
        'pointSize'=>$data["pointSize"],
        'start'=>$start,
        'results'=>$results,
    ]);
    }


}
