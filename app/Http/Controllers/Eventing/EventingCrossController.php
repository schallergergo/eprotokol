<?php

namespace App\Http\Controllers\Eventing;

use App\Models\EventingCross;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Eventing\EventingController;
use App\Http\Requests\UpdateEventingCrossRequest;
class EventingCrossController extends Controller
{
   
   



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventingCross  $eventingCross
     * @return \Illuminate\Http\Response
     */
    public function edit(EventingCross $eventingCross)
    {
        //$this->authorize('update', $eventingCross->start );
        return view("eventing.cross.edit",["start"=>$eventingCross->start,"cross"=>$eventingCross]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventingCrossRequest  $request
     * @param  \App\Models\EventingCross  $eventingCross
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventingCrossRequest $request, EventingCross $eventingCross)
    {   $start = $eventingCross->start;
        //$this->authorize('update', $start );
        $data = $request->validated();
        $data = array_merge($data,["completed"=>true]);
        $eventingCross->update($data);

        $eventingContoller = new EventingController();
        $eventingContoller->update($eventingCross->start);
        return redirect("event/show/".$start->event->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventingCross  $eventingCross
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventingCross $eventingCross)
    {
        //
    }
}
