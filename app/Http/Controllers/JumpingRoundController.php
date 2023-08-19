<?php

namespace App\Http\Controllers;

use App\Models\JumpingRound;
use App\Models\Style;
use App\Models\Start;
use App\Models\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJumpingRoundRequest;
use App\Http\Requests\UpdateJumpingRoundRequest;
use App\Http\Requests\UpdateJumpingRoundRequest2;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class JumpingRoundController extends Controller
{

    public function createRound(Start $start){

        JumpingRound::create(["start_id"=>$start->id]);

    }




public function edit(JumpingRound $jumping_round){


        $this->authorize("update",$jumping_round);
        return view("jumpinground.edit",[ 
                                    "start"=>$jumping_round->start,
                                    "round"=>$jumping_round,
                                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlockRequest  $request
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJumpingRoundRequest $request, JumpingRound $jumping_round)
    {

        $this->authorize("update",$jumping_round);
        
        $data=$request->validated();
        $data = array_merge($data,["completed1"=>1]);
        return $this->updateHelper($data,$jumping_round);

    }


    public function update2(UpdateJumpingRoundRequest2 $request, JumpingRound $jumping_round){
        $this->authorize("update",$jumping_round);
        
        $data=$request->validated();
        $data = array_merge($data,["completed2"=>1]);
        return $this->updateHelper($data,$jumping_round);
    }
    
    public function replicateJumpingRound(Start $start,Start $newStart){


        foreach($start->jumping_round as $round) {
            $newRound = $round->replicate();
            $newRound->start_id = $newStart->id;
            $newRound->save();

        }
       
        }

    private function updateHelper(array $data,JumpingRound $jumping_round){

        
        $jumping_round->update($data);
        if ($jumping_round->eliminated1) $jumping_round->total_fault1=1000;
                if ($jumping_round->eliminated2) $jumping_round->total_fault2=1000;
        $jumping_round->save();
        $start = $jumping_round->start;
        $start->completed=1;
        $start->eliminated = $jumping_round->eliminated1;
        $start->mark = $jumping_round->total_fault1;
        $start->save();
        $this->isAllRoundsCompleted($jumping_round);
        $this->generateLog($jumping_round);
        return redirect("event/show/".$jumping_round->start->event->id);
    }
    private function generateLog($round){

        $user = Auth::user();

        $message =$user->name;;
        $message = $message." - rounds -".$round;
        Log::channel("showjumping")->info($message);
    }

    private function isAllRoundsCompleted(JumpingRound $jumping_round){
        $start = $jumping_round->start;
        $event = $start->event;
        $rounds = $start->jumping_round;

        

            $startController = new StartController();
            if ($event->program->typeofevent=="pkx") $startController->calculatePKXRank($start);
            else $startController->calculateRoundRank($start);
         
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(JumpingRound $jumping_round)
    {
        $jumping_round->delete();

    }
}
