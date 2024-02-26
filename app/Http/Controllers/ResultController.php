<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

use App\Http\Controllers\Result\ResultNormalController;
use App\Http\Controllers\Result\ResultCaprilliController;
use App\Http\Controllers\Result\ResultShortFormController;
use App\Http\Controllers\Result\ResultJumpingRoundController;
use App\Http\Controllers\ResultlogController;

use App\Events\ResultChanged;
use App\Models\Result;
use App\Models\Event;
use App\Models\User;
use App\Models\Official;
use App\Models\Start;
use App\Mail\ResultMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
 

class ResultController extends Controller
{
        public function __construct()
    {
        $this->authorizeResource(Result::class);
    }
    
    //Shows a given result based on its id
    public function show(Result $result){
        $user=Auth::user();
        if ($user==null) $user="anonim";
        else $user=$user->name;
    Log::channel("resultOpen")->info($user.' opened '.$result->id);
      $typeofevent=$result->start->event->program->typeofevent;

      switch ($typeofevent) {
          case 'normal':
              $controller = new ResultNormalController();
              break;
           case 'shortform':
              $controller = new ResultShortFormController();
              break;
            case 'caprilli':
              $controller = new ResultCaprilliController();
              break;
            case 'oneround':
              $controller = new ResultJumpingRoundController();
              break;
          default:
              $controller = new ResultNormalController();
              break;

      }

      return $controller->show($result);
    }

   
    //editing a result, this is method is used both for the first edit, and for the edits afterwards

    public function edit(Result $result){
        $this->lastOpened($result);
       $typeofevent=$result->start->event->program->typeofevent;

      switch ($typeofevent) {
          case 'normal':
              $controller = new ResultNormalController();
              break;
          case 'shortform':
              $controller = new ResultShortFormController();
              break;
        case 'caprilli':
              $controller = new ResultCaprilliController();
              break;
        case 'oneround':
              $controller = new ResultJumpingRoundController();
              break;
          default:
              $controller = new ResultNormalController();
              break;
         
      }

      return $controller->edit($result);
    }
    private function lastOpened(Result $result){
        $userRole=Auth::User()->role;
        if ($userRole!=="penciler" || $result->position!="C") return;
        $event=$result->start->event;
        $event->last_opened=$result->start->id;
        $event->save();
    }
    //result log: logs every modification, for every result, triggered by the update function
    public function ResultLog($result_id,$mark,$assessment){
        \App\Models\Resultlog::create([
            'result_id' => $result_id,
            'mark'=>$mark,
            'assessment'=>$assessment,
            'user'=>Auth::User()->name,

        ]);
    }

    // stores the empty result in the database
    public function store(Start $start,Official $official)
    {$data = request();

        //number of blocks for a given program, 
        $numOfBlocks=$start->event->program->numofblocks;
        
        \App\Models\Result::create([
            'id' => strval($this->generateID()),
            'start_id' => $start->id,
            'official_id'=> $official->id,
            'position'=> $official->position,
            'assessment'=>$this->generateEmptyJson($numOfBlocks),
        ]);
        return true;
    }

    public function update(Result $result)
    {
        $this->authorize('update', $result);
        // POST data
       
       
         $typeofevent=$result->start->event->program->typeofevent;

      switch ($typeofevent) {
          case 'normal':
              $controller = new ResultNormalController();
              break;
          case 'shortform':
              $controller = new ResultShortFormController();
              break;

        case 'caprilli':
              $controller = new ResultCaprilliController();
              break;
          default:
              $controller = new ResultNormalController();
              break;
          }
        $sucess=$controller->update($result);
        if (!$sucess) return redirect("result/edit/{$result->id}") ->with("fail",Lang::get("Something is missing!"));
         //creating a log record
        $this->ResultLog($result->id,$result->mark,$result->assessment);
       
        //updating the result record
        $start=$result->start;
        $startController = new StartController();
        $startController->calculateAllJudges($start);
         
        return redirect("result/show/{$result->id}")
        ->with("status",Lang::get("Successfully saved!"));
        
    }
    public function ajaxUpdate(Result $result){
        if ($result->completed>0) return response("Already completed",403);
        $data = request();
        $assessment=json_encode($data->assessment);
        $jsonAssessment=str_replace("null","\"\"",$assessment);
        $result->assessment=$jsonAssessment;
        $result->error=$data->error;
        $result->save();
        $this->calculatePartialResult($result);


        //ResultChanged::dispatch($result);
        return response($jsonAssessment,200);
    }

     public function destroy(Result $result){

        $result->delete();       
    }
    public function search(){
        $data = request();

        if (!isset($data["search"])) return view("result.search");
        $data=$data->validate([
            'search' => [],
            ]);
        $searchTerm=$data["search"];
        $results=Result::where("completed",1)
                ->where(function($query) use ($searchTerm){
                    $query->where("rider_name","LIKE","%".$searchTerm."%")
                            ->orWhere("rider_id",$searchTerm)
                            ->orWhere("horse_id",$searchTerm)
                            ->orWhere("horse_name","LIKE","%".$searchTerm."%");})
                ->orderBy("rider_name")
                ->get();

        return view("result.search",["results"=>$results]);
    }

    public function replicateResult(Start $start, Start $newStart, $officials){


         foreach($start->result as $result) {
            $newResult = $result->replicate();
            $newResult->start_id = $newStart->id;
            $newResult->official_id = $officials->where("position",$result->position)->first()->id;

            $newResult->id = $this->generateID();
            $newResult->save();
            $controller = new ResultlogController();
            $controller->replicateResultlog( $newResult);
        }

    

    }



       private function generateID(){

        //lower limit of the id
        $limit = 100000000000000000;

        //generating a random id
        $id = rand($limit,$limit*10);

        //checking if a record already exists with the given id
        $result = Result::withTrashed()->find($id);

        // iterating the last two steps until id is found
        while ($result!==null){
            $id = rand($limit,$limit*10);
            $result = Result::withTrashed()->find($id);
        }

        return $id;
    }

    //calculating the result


    //generating an empty assessment json based on the number of blocks
    private function generateEmptyJson(int $numOfBlocks){
        $outputArray=array();
        for ($i=0;$i<$numOfBlocks;$i++){
            $temp=['mark'=>"",'remark'=>""];
            $outputArray[]=$temp;
        }
        return json_encode($outputArray);
    }

private function calculatePartialResult(Result $result){
         //-1 means elimination: return 0
        $markArray=json_decode($result->assessment);
        $error=$result->error;

        if ($error==-1) return 0;
        $points=0;
        $maxPoint=0;
        //the blocks of the program, contains the multiplication coefficient
        $blocks=$result->start->event->program->block;

        //sanity check: is the number of marks and block equal?
        if (count($blocks)!=count($markArray)) return 0;

        //calculating the result based on the mark given and the coefficient
        for ($i=0;$i<count($blocks);$i++){
            if ($markArray[$i]->mark!=""){
                if ($markArray[$i]->mark>=0 && $markArray[$i]->mark<=$blocks[$i]->maxmark){
            $points+=$markArray[$i]->mark*$blocks[$i]->coefficient;
            $maxPoint+=$blocks[$i]->maxmark*$blocks[$i]->coefficient;
                }
            }
        }
        if ($maxPoint==0) return 0;
        $result->mark=$points;
        $result->percent=($points-$error)*100.0/$maxPoint;
        $result->save();
    }

     public function restore(Result $result){



            $result->restore($result);

       

    }
    

    

}