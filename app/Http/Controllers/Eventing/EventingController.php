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

        $this->calculateRank($start->event);

    }
     public function rankingView(Event $event)
    {

        $eventing = $event->eventing;
        $starts = $event->start;
        $categories = $starts->unique('category')->pluck('category');
        $startsWithCategory = [];
        foreach ($categories as $category){
           $startsWithCategory[$category] = $starts->where('category', $category);
        }
        return view('eventing.ranking',['competition'=>$event->competition,'categories'=>$startsWithCategory,]);

    }

   public function calculateRank(Event $event)
        {
            $starts = $this->getEventingStarts($event);
        
            if ($starts->isEmpty()) {
                return;
            }
        
            $currentCategory = null;
            $rank = 0;
        
            foreach ($starts as $start) {
        
                // New category → reset rank
                if ($start->category !== $currentCategory) {
                    $currentCategory = $start->category;
                    $rank = 1;
                } else {
                    $rank++;
                }
        
                $start->rank = $rank;
                $start->save();
            }
            return redirect('/event/show/'.$event->id);
        }
    
   private function getEventingStarts(Event $event)
        {
            return Start::hydrate(
                DB::table('eventings as e')
                    ->join('starts as s', 's.id', '=', 'e.start_id')
                    ->leftJoin('eventing_show_jumpings as sj', 'sj.start_id', '=', 's.id')
                    ->leftJoin('eventing_crosses as ec', 'ec.start_id', '=', 's.id')
                    ->leftJoin('eventing_extra_infos as i', 'i.event_id', '=', 's.event_id')
                    ->where('s.event_id', $event->id)
                    ->where('s.deleted_at',null)
                    ->select('s.*')
                    ->orderBy('s.category')
                    ->orderBy('e.fault')
                    ->orderBy('ec.total_fault')
                    ->orderBy('s.mark')
                    ->orderByRaw('ABS(i.cross_time_allowed - ec.time)')
                    ->orderBy('sj.total_fault')
                    ->orderBy('sj.time')
                    ->orderBy('s.collective')
                    ->get()
                    ->toArray()
            )->unique('id')->values();
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
