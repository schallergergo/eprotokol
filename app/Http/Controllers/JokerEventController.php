<?php

namespace App\Http\Controllers;
use App\Models\Competition;
use App\Models\JokerEvent;
use App\Models\Start;
use App\Models\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJokerEventRequest;
use App\Http\Requests\UpdateJokerEventRequest;

class JokerEventController extends Controller
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
    public function create(Competition $competition)
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJokerEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Competition $competition)
    {
        dd(request());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JokerEvent  $jokerEvent
     * @return \Illuminate\Http\Response
     */
    public function show(JokerEvent $jokerEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JokerEvent  $jokerEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(Start $start)
    {
        $this->authorize('update', $start );
        return view('jokerevent.edit',['start'=>$start]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJokerEventRequest  $request
     * @param  \App\Models\JokerEvent  $jokerEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Start $start)
    {
        $this->authorize('update', $start );
        $data = request();



            foreach ($data->results as $result) {
                $event = Result::find($result['id']);

                if ($event) {
                    $event->update([
                        'mark' => $result['mark'],
                        'collective' => $result['collective'],
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Events updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JokerEvent  $jokerEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(JokerEvent $jokerEvent)
    {
        //
    }
}
