<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Competition;
use App\Models\Event;
use App\Models\Start;
use App\Http\Requests\StoreChampionshipRequest;
use App\Http\Requests\UpdateChampionshipRequest;
use App\Http\Controllers\ChampionshipType\PKDressageController;
use App\Http\Controllers\ChampionshipType\PKShowJumpingController;
use App\Http\Controllers\ChampionshipType\PKTeamDressageController;
use App\Http\Controllers\ChampionshipType\PKTeamShowJumpingController;
use App\Http\Controllers\ChampionshipType\PKClubController;
use Illuminate\Support\Facades\Auth;

class ChampionshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeChampionships=Championship::orderBy("created_at")->where("active",1)->paginate(20);
        $closedChampionships=Championship::orderBy("created_at")->where("active",0)->paginate(20);
        return view("championship.index",["closedChampionships"=>$closedChampionships,"activeChampionships"=>$activeChampionships]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', [Championship::class]);
        return view("championship.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChampionshipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChampionshipRequest $request)
    {
        $this->authorize('create', [Championship::class]);
        $data=$request->validated();

        $newChampionship=\App\Models\Championship::create([
            'championshipname' => $data["championshipname"],
            'discipline' => $data["discipline"],
            'office'=>Auth::user()->id,
            'type'=>$data["type"],
        ]);

        return redirect("/championship/edit/{$newChampionship->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Championship  $championship
     * @return \Illuminate\Http\Response
     */
    public function show(Championship $championship)
    {   
        



        if ($championship->type=="pkdressage") $controller = new PKDressageController();
        if ($championship->type=="pkshowjumping") $controller = new PKShowJumpingController();
        if ($championship->type=="pkteamdressage") $controller = new PKTeamDressageController();
        if ($championship->type=="pkteamshowjumping") $controller = new PKTeamShowJumpingController();
        if ($championship->type=="pkclub") $controller = new PKClubController();
        return $controller->show($championship);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Championship  $championship
     * @return \Illuminate\Http\Response
     */
    public function edit(Championship $championship)
    {
        $this->authorize('update', $championship);
        $competitions=Competition::where("discipline", $championship->discipline)->orderBYDesc("created_at")->get();
        $eventIds=json_decode($championship->events);
        $addedEvents=array();
        foreach($eventIds as $id) {
            $event=Event::find($id);
            if ($event==null) $this->removeEventFromList($championship,$id);
            else $addedEvents[]=$event;

            }



        return view("championship.edit",
            [
                "championship"=>$championship,
                "competitions"=>$competitions,
                "addedEvents"=>$addedEvents,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChampionshipRequest  $request
     * @param  \App\Models\Championship  $championship
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChampionshipRequest $request, Championship $championship)
    {
                $this->authorize('update', $championship);
                $data=$request->validated();
                $championship->update($data);
                return redirect()->back();
    }


    public function addEvent(Championship $championship){
        $this->authorize('update', $championship);
        $data=request();

        $data=$data->validate([
            'competition' => ["required"],
            'event'=>["required",'integer',"min:0"],
            ]);

        $events=json_decode($championship->events);

        if (!in_array($data["event"],$events)) {

            $events[]=$data["event"];
            $championship->events=json_encode($events);
            $championship->save();

        }
        return redirect()->back();
    }

     public function changeStatus(Championship $championship){
        $this->authorize('update', $championship);
        
        $championship->active = !$championship->active;
        $championship->save();
        return redirect()->back();
    }
    


    public function removeEvent(Championship $championship){
        $this->authorize('update', $championship);
        $data=request();

        $data=$data->validate([

            'event_id'=>["required",'integer',"min:0"],
            ]);

        $events=json_decode($championship->events);
        $index=array_search($data["event_id"],$events);
 
        unset($events[$index]);
        $championship->events=json_encode(array_values($events));
        $championship->save();
        return redirect()->back();
    }

    private function removeEventFromList(Championship $championship,int $id){
        

        $events=json_decode($championship->events);
        $index=array_search($id,$events);
        unset($events[$index]);
               $championship->events=json_encode(array_values($events));
        $championship->save();

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Championship  $championship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Championship $championship)
    {
        $this->authorize('delete', $championship);
        $championship->delete();
        return redirect("/championship/index");
    }

}
