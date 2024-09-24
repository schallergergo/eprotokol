<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\Event;
use App\Models\User;
use App\Http\Requests\StoreOfficialRequest;
use App\Http\Requests\UpdateOfficialRequest;

class OfficialController extends Controller
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
   public function create(Event $event){

        $this->authorize('create',[Official::class,$event]);
        $pencilers = User::all()->where("role","penciler");
        $positions=$this->availablePositions($event);

    return view("/official/create",[
            "event"=>$event,
            "positions"=>$positions,
            "pencilers"=>$pencilers]);
    } 
    private function availablePositions(Event $event){
        
        $positions=["C","E","B","K","F","M","H"];
        if (!$event->program->has_result)  $positions= ["SJ"];
        $officials=$event->official;

        foreach ($officials as $official ){
            $position=array_search($official->position,$positions);
            if ($position!==false)
            {
                unset($positions[$position]);
            }
        }
        return $positions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOfficialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfficialRequest $request,Event $event)
    {
         $this->authorize('create',[Official::class,$event]);


        //validation rules
        $data=$request->validated();

       
        $event_id=$event->id;

      

        $newOfficial=\App\Models\Official::create([
            'event_id' => $event_id,
            'judge' => $data["judge"],
            'position' => $data["position"],
            'judge' => $data["judge"],
            'penciler' => $data["penciler"],

        ]);
        if ($event->program->has_result) {
            $this->addResultEntries($newOfficial);
            $this->notCompleted($newOfficial);
        }
        return redirect("event/edit/{$event->id}");
    }
    private function addResultEntries(Official $newOfficial){
        $resultController= new ResultController();
        foreach ($newOfficial->event->start as $start){
            $resultController->store($start,$newOfficial);
        }
 
    }
     private function notCompleted(Official $newOfficial){
        $startController= new StartController();
        foreach ($newOfficial->event->start as $start){
            $startController->notCompleted($start);
        }
 
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function show(Official $official)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function edit(Official $official)
    {
         $this->authorize('update',$official);
       $pencilers = User::all()->where("role","penciler");

        return view("/official/edit",[
                "official"=>$official,
                "pencilers"=>$pencilers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfficialRequest  $request
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfficialRequest $request, Official $official)
    {
        $this->authorize('update',$official);

        $data=$request->validated();

        $official->update($data);
        return redirect("event/edit/{$official->event->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function destroy(Official $official)
    {
         $this->authorize('delete',$official);
        $resultController = new ResultController();
        foreach($official->event->start as $start){
            $result=$start->result->where('position',$official->position);

            $resultController->destroy($result->first());
        } 
        $official->delete();
        return redirect("event/edit/{$official->event->id}");
    }

    public function replicateOfficial(Event $fromEvent, Event $toEvent){

        foreach($fromEvent->official as $official){
            $newOfficial = $official->replicate();
            $newOfficial->event_id = $toEvent->id;
            $newOfficial->save();

           

        }
    }


    }
