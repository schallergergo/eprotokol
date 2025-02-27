<?php

namespace App\Http\Controllers\Eventing;

use App\Models\EventingExtraInfo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventingExtraInfoRequest;
use App\Http\Requests\UpdateEventingExtraInfoRequest;

class EventingExtraInfoController extends Controller
{
    





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eventing\EventingExtraInfo  $eventingExtraInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(EventingExtraInfo $eventingExtraInfo)
    {



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventingExtraInfoRequest  $request
     * @param  \App\Models\Eventing\EventingExtraInfo  $eventingExtraInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventingExtraInfoRequest $request, EventingExtraInfo $eventingExtraInfo)
    {
        $event = $eventingExtraInfo->event;
        $this->authorize("update",[$event]);
        $data = $request->validated();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eventing\EventingExtraInfo  $eventingExtraInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventingExtraInfo $eventingExtraInfo)
    {
        //
    }
}
