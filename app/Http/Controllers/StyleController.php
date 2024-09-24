<?php

namespace App\Http\Controllers;

use App\Models\Style;
use App\Models\Start;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStyleRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class StyleController extends Controller
{


    public function createStyle(Start $start){

        Style::create(["start_id"=>$start->id]);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function edit(Style $style)
    {
        $this->authorize("update",$style);
        return view("style.edit",[ 
                                    "start"=>$style->start,
                                    "style"=>$style,
                                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStyleRequest $request, Style $style)
    {   
        $this->authorize("update",$style);

        $data=$request->validated();
        $data = array_merge($data,["completed"=>1]);
        $style->update($data);
        if ($style->eliminated) $style->total_fault=1000;
        $style->save();
        $start = $style->start;
        $start->completed=1;
        $start->mark = 10-$data["total_mark"];
        $start->percent = $data["total_mark"]*10.0;
        $start->save();
        $this->isAllRoundsCompleted($style);
        $this->generateLog($style);
        return redirect("event/show/".$style->start->event->id);
    }


    public function replicateStyle(Start $start,Start $newStart){


        foreach($start->style as $style) {

            $newStyle = $style->replicate();
            $newStyle->start_id = $newStart->id;
            $newStyle->save();

        }
    }

    private function generateLog($round){

        $user = Auth::user();

        $message =$user->name;;
        $message = $message." - style -".$round;
        Log::channel("showjumping")->info($message);
    }

     private function isAllRoundsCompleted(Style $style){

        
            $start = $style->start;
            $startController = new StartController();
            $startController->calculateStyleRank($start);
         
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function destroy(Style $style)
    {
        $style->delete();
    }
}
