<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Start;
use App\Models\Program;
use App\Models\Competition;
use App\Models\User;
use App\Models\Sponsor;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Auth;
use App\Exports\ResultExport;
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
        $this->authorize('create', [Event::class,$competition]);
        $programs=Program::all()->
        where("discipline",$competition->discipline)->
        where("active",1);

        return view("/event/create",[
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
        return view("/event/edit",["programs"=>$programs,
                                    "event"=>$event,
                                    "officials"=>$officials,
                                    "sponsors"=>$sponsors,
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
        return back();    
    }


    public function recalculateEvent(Event $event){
        $this->authorize('update', $event);
        $startController= new StartController();
        foreach($event->start as $start){
            $startController->recalculateStart($start);
        }
        return redirect("/event/show/{event->id}");
    }

 public function exportEvent(Event $event){
        return Excel::download(new ResultExport($event), 'result.xlsx');
    }
}
