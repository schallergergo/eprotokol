<?php

namespace App\Http\Controllers;

use App\Models\DisplayStatus;
use App\Models\Competition;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDisplayStatusRequest;
use App\Http\Requests\UpdateDisplayStatusRequest;

class DisplayStatusController extends Controller
{
    public function pushToLive(Competition $competition)
{
    $request = request();
    //dd($request);
    $validated = $request->validate([
        'competitionId' => 'required|integer',
        'eventId' => 'nullable|integer',
        'eventName' => 'nullable|string',
        'display' => 'nullable|string',
        'title' => 'nullable|string|max:255',
        'message' => 'nullable|string|max:1000',

        
        'completedStartData' => 'nullable|array',
        'pendingStartData' => 'nullable|array',
        'automaticEvents' => 'sometimes|array',
        'automaticArray' => 'sometimes|array',
    ]);
    if (!isset($validated['automaticEvents'])) $validated['automaticEvents'] =[];
    // ✅ Save (one state per competition)
    //dump($request);
    //dd($validated);
    $state = DisplayStatus::updateOrCreate(
        ['competition_id' => $competition->id],
        [
            'event_id' => $validated['eventId'] ?? null,
            'event_name' => $validated['eventName'] ?? null,
            'display' => $validated['display'] ?? null,
            'title' => $validated['title'] ?? null,
            'message' => $validated['message'] ?? null,

            'completed_data' => json_encode($validated['completedStartData']) ?? null,
            'automatic_events' => json_encode($validated['automaticEvents']) ?? null,
            //'automaticArray' => json_encode($validated['automaticArray']) ?? null,
        ]
    );

    return response()->json([
        'success' => true,
        'data' => $state
    ]);
}


public function getDisplayStatus(Competition $competition)
{
   $status = DisplayStatus::where('competition_id',$competition->id)->get();
   return $status;
}


}
