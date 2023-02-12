<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Competition;
use App\Models\Event;
use App\Models\Start;
use App\Http\Requests\StoreChampionshipRequest;
use App\Http\Requests\UpdateChampionshipRequest;

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
        $championships=Championship::orderByDesc("created_at")->paginate(20);
        return view("championship.index",["championships"=>$championships]);
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
            'office' => Auth::user()->id,

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
        $events=$this->getEventsArray(json_decode($championship->events));
        $numberOfEvents=count($events);
        $startsArray=array();
        $mergedStarts= collect([]);
        $uniqueStarts;

        foreach ($events as $event){
            $starts        = $event->start;
            $startsArray[] = $starts;
            $mergedStarts  = $mergedStarts->merge($starts);
        }

        
        $uniqueStarts=$mergedStarts->unique("twoIds");
    //dd($uniqueStarts->sortBy("rider_name")); 
        $withAllStarts = array();
        $withoutAllStarts = array();
        foreach($uniqueStarts as $start){
            $foundStarts=$this->getAllStarts($startsArray, $start);
            if (count($foundStarts["starts"])==$numberOfEvents) $withAllStarts[]=$foundStarts;
            else $withoutAllStarts[]=$foundStarts;
        }
        $withAllStarts=collect($withAllStarts);
        $categories=collect($withAllStarts)->unique("category");
        $startsWithCategories=[];
        foreach($categories as  $category){
            $startsWithCategories []= $withAllStarts->where("category",$category["category"])->sortByDesc("avg");
        }

                //dd($withAllStarts);
        $withoutAllStarts=collect($withoutAllStarts)->sortByDesc("avg")->sortBy("category");

        return view("championship.show",[
            "championship"=>$championship,
            "startsWithCategories"=>$startsWithCategories,
            "withoutAllStarts"=>$withoutAllStarts,
        ]);

    }

    private function getEventsArray (array $events){
        $outputArray=array();
        foreach ($events as $event){
            $foundEvent = Event::find($event);
            if ($foundEvent!= null) $outputArray[]=$foundEvent;
        }
        return $outputArray;
    }


    private function getAllStarts(array $startsArray, Start $start){

        $outputArray = array();
        $collection=collect([]);
        foreach ($startsArray as $starts){
            
            $foundStart=$starts->where("rider_id",$start->rider_id)->where("horse_id",$start->horse_id);

            if (count($foundStart)>0) $collection=$collection->merge($foundStart);
        }
        $avg=$collection->where("completed",">",0)->avg("percent") ?? 0;

        $category = $collection->first()->category;

        return collect(["category"=>$category,"starts"=>$collection,"avg"=>$avg]);
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
        $competitions=Competition::where("discipline", $championship->discipline)->get();
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

    private function removeEventFromList(Championship $championship,integer $id){
        

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
