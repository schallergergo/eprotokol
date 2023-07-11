<?php

namespace App\Http\Controllers\Result;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Http\Controllers\Controller;
class ResultShortFormController extends Controller
{
     //Shows a given result based on its id
    public function show(Result $result){

        $start=$result->start;
        if ($result->completed==0) redirect("/event/show/{$start->event->id}");
        $assessment=json_decode($result["assessment"]);
        
        $program = $result->start->event->program;
        dd($assessment);
        $count=count($assessment);

        while (count($program->block) > $count){
            $temp=["remark"=>"","mark"=>"0"];
            $temp=[$count=>$temp];
            //dd($temp);
            //$assessment = array_merge($assessment,$count=>);
            $count++;
        }
        $result->update(["assessment"=>json_encode($assessment)]);

        //first part of the program, with the moves to be executed
        $blocks=$program->block->where("programpart",1); 

        //second part, with the criteria for the collective marks
        $collectivemarks=$result->start->event->program->block->where("programpart",2); 

        //errors made by the rider, aka deductions
        $error=$result->error; 

        // bool: is the rider eliminated?
        $eliminated=$result->eliminated; 


        return view("result.shortform.show",[ "result"=>$result, 
                                    "start"=>$start,
                                    "program"=>$program,
                                    "blocks"=>$blocks,
                                    "collectivemarks"=>$collectivemarks,
                                    "assessment"=>$assessment,
                                    "error"=>$error,
                                    "eliminated"=>$eliminated,
                                ]);
    }

    public function edit(Result $result){

        //first part of the program, with the moves to be executed
        $blocks=$result->start->event->program->block->where("programpart",1);

        //second part, with the criteria for the collective marks
        $collectivemarks=$result->start->event->program->block->where("programpart",2);

        //json: the remarks and points given by the judge, blank values, if it has not been  completed
        $assessment=json_decode($result->assessment);

        //errors made by the rider, aka deductions
        $error=$result->error;

        // bool: is the rider eliminated?
        $eliminated=$result->eliminated;
        $start=$result->start;
        return view("result.shortform.edit",[ "result"=>$result,
                                    "start"=>$start,
                                    "blocks"=>$blocks,
                                    "collectivemarks"=>$collectivemarks,
                                    "assessment"=>$assessment,
                                    "error"=>$error,
                                    "eliminated"=>$eliminated,
                                ]);
    }

    public function update(Result $result)
    {
 // POST data
        $data = request();

        $resultID=$result->id;

        //array for the marks and remarks given by the judge
        $array=[];

        for($i=0;$i<count($data['mark']);$i++)
        {
                //given mark
                $mark=$data['mark'][$i];
                if ($data['mark'][$i]=="") return false;
                //remark: if null replaced with an empty string
                $remark=$data['remark'][$i]==null?"":$data['remark'][$i];

                //adding it to the array
                $array[]=['mark'=>$mark,'remark'=>$remark];
        }

        // if the rider is eliminated, set the mark to zero
        if ($data["eliminated"]==1) $mark = 0;

        //calcalate the result
        else $mark = $this->mark($result,$array,$data["error"]);

        //calculate the percentage
        $percent  = $this->percent($result,$mark);



        //encoding the marks and remarks to json
        $assessment = json_encode($array);

        //is the rider eliminated, 3 errors or for some other reason
        $eliminated = isset($data["eliminated"]) || $data["error"]==-1 ? 1 : 0;

        $dataOut=[  
                    "assessment"=>$assessment,
                    "completed"=>$result->completed+1,
                    "mark"=>$mark,
                    "percent"=>$percent,
                    "collective"=>$collectivemark,
                    "eliminated"=>$eliminated,
                    "error"=>$data["error"],
                ];
        $result->update($dataOut);
        return true;
      
    }

      private function mark(Result $result, array $markArray, float $error){
        //-1 means elimination: return 0
        if ($error==-1) return 0;
        $points=0;

        //the blocks of the program, contains the multiplication coefficient
        $program=$result->start->event->program;
        $blocks=$program->block;

        //sanity check: is the number of marks and block equal?
        if (count($blocks)!=count($markArray)) return 0;

        //calculating the result based on the mark given and the coefficient
        for ($i=0;$i<count($blocks);$i++){
            $points+=$markArray[$i]["mark"]*$blocks[$i]->coefficient;
        }

        return $points-$this->calculateError($program,$points,$error);
    }

     private function percent(Result $result, float $point){
        $total=0;
        $maxMark=$result->start->event->program->maxMark;
        
        return $point*100.0/$maxMark;
    }
    
    //calculating the collective marks
    private function collectiveMarkPoint(Result $result){
        //-1 means elimination: return 0
        return 0;
    }
}


