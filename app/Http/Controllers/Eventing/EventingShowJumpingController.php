<?php

namespace App\Http\Controllers\Eventing;

use App\Models\EventingShowJumping;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventingShowJumpingRequest;
use App\Http\Requests\UpdateEventingShowJumpingRequest;

class EventingShowJumpingController extends Controller
{
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventingShowJumping  $eventingShowJumping
     * @return \Illuminate\Http\Response
     */
    public function edit(EventingShowJumping $eventingShowJumping)
    {
        //$this->authorize('update', $eventingShowJumping->start );
        return view("eventing.sj.edit",["start"=>$eventingShowJumping->start,"show_jumping"=>$eventingShowJumping]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventingShowJumpingRequest  $request
     * @param  \App\Models\EventingShowJumping  $eventingShowJumping
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventingShowJumpingRequest $request, EventingShowJumping $eventingShowJumping)
    {
        //$this->authorize('update', $eventingShowJumping->start );
        $data = $request->validated();
        $data = array_merge($data,["completed"=>true]);
        $eventingShowJumping->update($data);

        $eventingContoller = new EventingController();
        $eventingContoller->update($eventingShowJumping->start);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventingShowJumping  $eventingShowJumping
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventingShowJumping $eventingShowJumping)
    {
        //
    }
}
