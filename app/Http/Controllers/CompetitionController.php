<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Tournament;
use App\Models\Event;
use App\Http\Requests\StoreCompetitionRequest;
use App\Http\Requests\UpdateCompetitionRequest;
use Illuminate\Support\Facades\Auth;

class CompetitionController extends Controller
{

     public function __construct()
        {
            $this->authorizeResource(Competition::class);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $competitions=Competition::orderBy('date','desc')->paginate(20); 
        return view("competition.index",[
            "competitions"=>$competitions,
            
        ]);
    }
    public function indexClosed(){
        $user=Auth::User();
        $toMatch=[
            "office"=>$user->id,
            "active"=>0,
            ];
        $competitions=Competition::where($toMatch)->orderBy('date','desc')->paginate(10); 
        return view("competition.index",["competitions"=>$competitions]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {

        return view("competition.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompetitionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompetitionRequest $request)
    {
        
        $data=$request->validated();

        $newCompetition=\App\Models\Competition::create([
            'name' => $data["name"],
            'venue' => $data["venue"],
            'date' => $data["date"],
            'discipline' => $data["discipline"],
            'office' => Auth::User()->id,
        ]);

        return redirect("/competition/show/{$newCompetition->id}");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {

        $events = Event::where("competition_id",$competition->id)->orderBy("rank")->get();
        return view("/competition/show",[
            "competition"=>$competition,
            "events"=>$events
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        $tournaments = Tournament::all()->sortByDesc("created_at");
        return view("/competition/edit",["competition"=>$competition,"tournaments"=>$tournaments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompetitionRequest  $request
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompetitionRequest $request, Competition $competition)
    {
        $data = request();
         $data=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'venue' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'tournament_id'=>["integer","nullable"],
            ]);
        $competition->update($data);
        return back();
    }
    public function updateActive(Competition $competition)
    {   
        $this->authorize('update', $competition);
        $state=$competition->active;
         $data=['active' => !$state];
        $competition->update($data);
        return redirect()->back();
    }

     public function activeEvents(Competition $competition){

        return $competition->active_event;
    }

    public function getEvents(Competition $competition){

        $events=$competition->event;
        $eventsArray=array();
        foreach ($events as $event){
            $eventsArray[]=["event_name"=>$event->event_name,"event_id"=>$event->id];
        }
        return json_encode($eventsArray);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $competition->delete();
        return redirect("/competition/index");
    }

        public function sort(Competition $competition){

        $this->authorize('update', $competition);



        $events = $competition->event->sortBy("rank");

     



        return view("competition.sort",["competition"=>$competition,"events"=>$events]);

    }
    public function saveOrder(Competition $competition){


        $this->authorize('update', $competition);
        $data = request()->validate([
                            'order'=>["required",'array']
                                    ]);
        $order = $data["order"];
        for ($i=0;$i<count($order);$i++){
            $event = Event::where("id",$order[$i])->first();
            $event->rank = $i+1;
            $event->save();

        }

         return response()->json([
            'success' => true,
            'message' => 'Order saved successfully!',
        ], 200);

    }



}
