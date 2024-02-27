<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Start;
use App\Models\Sponsor;
use App\Models\Program;
use App\Models\Competition;
use App\Models\User;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Controllers\StartController;
use App\Http\Controllers\OfficialController;

use Illuminate\Support\Facades\Auth;
use App\Exports\ResultExport;
use App\Exports\JumpingRoundExport;
use App\Exports\StyleExport;


use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Competition $competition){
        $this->authorize('create', [App\Models\Event::class,$competition]);
        $programs=Program::where("discipline",$competition->discipline)->
        where("active",1)->orderBy("ordinal")->get();

        return view("event.create",[
            "programs"=>$programs,
            "competition"=>$competition]);
    } 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request,Competition $competition)
    {
        $this->authorize('create', [Event::class,$competition]);
        $data = request();

        //validation rules
        $data=$request->validated();

       
        $office=Auth::User()->id;

      

        $newEvent=\App\Models\Event::create([
           
            'event_name' => $data["event_name"],
            'program_id' => $data["program_id"],
            'competition_id'=>$competition->id,
        ]);
        $newEvent->rank=$newEvent->id;
        $newEvent->save();
        return redirect("competition/show/{$competition->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
        public function show(Event $event)
    {
        
         //riders in the event with no results
    $starts=Start::where("event_id",$event->id)->get();
    
    $toStart=$starts->where("completed",0)->sortBy("rank");

    //riders in the event with completed results
    $started=$starts->where("completed",">",0)->sortBy("rank")->sortBy("category");

    $categories=$started->unique("category")->sortBy("category")->pluck("category")->all();
    
    $startedArray=array();
    foreach($categories as $category){
        $startedArray[]=$started->where("completed",">",0)->where("category",$category);
        
    }
    return view("event.show",  ["event"=>$event,
                                 "startedArray"=>$startedArray,
                                 "toStart"=>$toStart,

                                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
     $this->authorize('update', $event);
        $programs=Program::all()->where("active",1);
        $pencilers=User::all()->where("role","penciler");
        $officials=$event->official;
        $sponsors=Sponsor::all()->sortBy("name");
        $categories=$event->start->pluck("category")->unique();
        return view("/event/edit",["programs"=>$programs,
                                    "event"=>$event,
                                    "officials"=>$officials,
                                    "sponsors"=>$sponsors,
                                    "categories"=>$categories,
                                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize('update', $event);
        $data = request();
        $data=$data->validate([
            'event_name' => ['required', 'string', 'max:255'],
            "sponsor_id"=>['required', 'integer'],
            ]);

        $event->update($data);
        return back();
    }

 public function destroy(Event $event){

        $event->delete();
        return redirect("/competition/show/{$event->competition->id}");    
    }


    public function recalculateEvent(Event $event){
        $this->authorize('update', $event);
        $startController= new StartController();
        foreach($event->start as $start){
            $startController->calculateRank($start);
        }
        return redirect("/event/show/{event->id}");
    }

 public function exportEvent(Event $event){
        $this->authorize('update', $event);
        $event_name = str_replace("/", "-", $event->event_name.'_results.xlsx');
         $typeofevent = $event->program->typeofevent;
        if ($typeofevent=="rounds" || $typeofevent=="pkx")
             return Excel::download(new JumpingRoundExport($event), $event_name);

         if ($typeofevent=="style")
            return Excel::download(new StyleExport($event), $event_name);



        return Excel::download(new ResultExport($event), $event_name);
    }

    public function exportEventByKondor(Event $event){
        $this->authorize('update', $event);
        $event_name = str_replace("/", "-", $event->event_name.'_results.xlsx');
         $typeofevent = $event->program->typeofevent;
        if ($typeofevent=="rounds" || $typeofevent=="pkx")
             return Excel::download(new \App\Exports\Kondor\JumpingRoundExport($event), $event_name);

         if ($typeofevent=="style")
            return Excel::download(new \App\Exports\Kondor\StyleExport($event), $event_name);



        return Excel::download(new \App\Exports\Kondor\ResultExport($event), $event_name);
    }

public function startlist(Event $event){


        $results = collect();
        foreach($event->start as $start){
            $results = $results->merge($start->result);
        }
        $results = $results->sortBy("updated_at");
        $starts = $event->start->sortBy("updated_at");

        return view("event.startlist",["event"=>$event,"results"=>$results]);
    }

public function deletedStarts(Event $event){

        $this->authorize('update', $event);
       $trashed = Start::onlyTrashed()->where("event_id",$event->id)->get();


        return view("event.deleted",["event"=>$event,"starts"=>$trashed]);
    }

    

public function resetCategory (Event $event){
        $this->authorize('update', $event);
            foreach ($event->start as $start){
                $start->category=$start->original_category;
                $start->save();
            }
            $this->recalculateEvent($event);
           return  redirect("/event/show/{$event->id}");
}
public function resetSponsor (Event $event){
        $this->authorize('update', $event);
           $event->last_opened=null;
           $event->save();
        return  redirect("/event/edit/{$event->id}");
}

public function updateCategory (Event $event){
        $this->authorize('update', $event);
            $data=request();
            $data=$data->validate([
                    'new_category' => ['required', 'string', 'max:255'],
                    'first_category' => ['required', 'string', 'max:255'],
                    'second_category' => ['required', 'string', 'max:255'],
                    ]);

            $starts=$event->start->where("category",$data["first_category"]);

            foreach($starts as $start){
                $start->category=$data["new_category"];
                $start->save();
            }

            $starts=$event->start->where("category",$data["second_category"]);

            foreach($starts as $start){
                $start->category=$data["new_category"];
                $start->save();
            }
            $this->recalculateEvent($event);
            return  redirect("/event/show/{$event->id}");
}
    
    public function copyEvent(Event $fromEvent, Event $toEvent){

        $this->authorize("update",$toEvent);
        if ($fromEvent->program->id != $toEvent->program->id ) return "Nem egyezik a program!!!";
        if ($fromEvent->program->typeofevent =="rounds" ||  $fromEvent->program->typeofevent =="style"){ 
        $controller = new OfficialController();
        $controller->replicateOfficial($fromEvent,$toEvent);

        $controller = new StartController();
        $controller->replicateStart($fromEvent,$toEvent);
            
        return redirect("/event/show/".$toEvent->id);
    }
    else return "Ezt nem tudja másolni!!!";
}

public function copyCategory(Event $fromEvent, Event $toEvent){
        $textOut="";
        $this->authorize("update",$toEvent);


        $fromStarts = $fromEvent->start;
        $toStarts = $toEvent->start;
        foreach($fromStarts as $start){
           $found = $toStarts->where("twoIds",$start->twoIds);
           if (count($found)==1) 
            {
                $found= $found->first();
                $found->category=$start->category;
                $found->save();
            }
           else $textOut=$textOut."nincs startja:".$start->rider_name." ".$start->horse_name."<br>";
        }
         $textOut .= "Minden ok";
        return $textOut;

        }
        

}
