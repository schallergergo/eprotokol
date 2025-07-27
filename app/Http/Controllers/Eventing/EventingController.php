<?php

namespace App\Http\Controllers\Eventing;

use App\Models\Eventing;
use App\Models\Start;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventingRequest;
use App\Http\Requests\UpdateEventingRequest;

class EventingController extends Controller
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

    public function show(Event $event){
        $starts = DB::table("starts")
                ->join("eventings",'eventings.start_id','=','starts.id' )
                ->select('starts.*','eventings.completed_count')
                ->where('starts.deleted_at',null)
                ->where('starts.event_id',$event->id)
                ->get();
        $max_completed_count = $starts->max('completed_count');
         //riders in the event with no results

         $starts = $starts->map(function ($item) {
                    return (new \App\Models\Start)->newFromBuilder((array) $item);
                });




    $notStarted=$starts->where("completed",-1)->sortBy("rider_name");



    $categories=$starts->unique("category")->sortBy("category")->pluck("category")->all();
    $to_start = $starts->where('completed_count' ,'<>',$max_completed_count);



    $started = $starts->where('completed_count',$max_completed_count);
    $categories=$started->unique("category")->sortBy("category")->pluck("category")->all();
    $starts_in_category = [];
    foreach ($categories as $category) {
        $starts_in_category[] = $started->where('category',$category);
    }

    $viewName = "eventing.eventing_event";

    return view($viewName,  ["event"=>$event,

                                 "toStart"=>$to_start,

                                 "notStarted"=>$notStarted,
                                 'starts_in_category'=> $starts_in_category

                                ]);

    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventingRequest  $request
     * @param  \App\Models\Eventing  $eventing
     * @return \Illuminate\Http\Response
     */
    public function update(Start $start)
    {   
        $eventing = $start->eventing;
        $cross = $start->eventing_cross;
        $showJumping = $start->eventing_show_jumping;


        $eventing->completed_count = $start->completed + $cross->completed +  $showJumping->completed;
        $eventing->eliminated = $start->eliminated || $cross->eliminated ||  $showJumping->eliminated;
        $percent = $start->percent==0 && $start->eliminated ? 1000 : 100.0 - $start->percent;
        $fault = $percent + $cross->total_fault +  $showJumping->total_fault;
        $eventing->fault = $fault;

        $eventing->save();

        $this->calculateRank($eventing);

    }

    private function calculateRank(Eventing $eventing)
    {
        /*-
        0 -> eventing.fault
        1 -> cross.total_fault
        2 -> start.mark
        3 -> cross.time_allowed_diff
        4 -> sj.total_faults
        5 -> sj.time
        6 -> start.collective
        7 -> never gonna happen
        
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eventing  $eventing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eventing $eventing)
    {
        //
    }
}
