<?php

namespace App\Http\Controllers;

use App\Models\Competition;
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

        return view("/competition/create");
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
        $events = $competition->event;
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
        return view("/competition/edit",["competition"=>$competition]);
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
         $data=$request->validated([
            'name' => ['required', 'string', 'max:255'],
            'venue' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            ]);
        $competition->update($data);
        return back();
    }

    public function activeEvents(Competition $competition){

        return $competition->active_event;
    }
    public function updateActive(Competition $competition)
    {   
        $this->authorize('update', $competition);
        $state=$competition->active;
         $data=['active' => !$state];
        $competition->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        //
    }
}
