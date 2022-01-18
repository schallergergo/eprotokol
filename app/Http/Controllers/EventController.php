<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Program;
use App\Models\Competition;
use App\Models\User;
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
    $toStart=$event->start->where("completed",0)->sortBy("rank");

    //riders in the event with completed results
    $started=$event->start->where("completed",1)->sortBy("rank")->sortBy("category");

    return view("/event/show",  ["event"=>$event,
                                 "started"=>$started,
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
        return view("/event/edit",["programs"=>$programs,
                                    "event"=>$event,
                                    "officials"=>$officials,
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

            ]);

        $event->update($data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
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
