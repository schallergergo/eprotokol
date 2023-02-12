<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Program;
class ResultNormalController extends Controller
{
    //Shows a given result based on its id
    public function show(Result $result){

        $start=$result->start;
        if ($result->completed==0) redirect("/event/show/{$start->event->id}");
        $assessment=json_decode($result["assessment"]);
        $program=$result->start->event->program;
        //first part of the program, with the moves to be executed
        $blocks=$program->block->where("programpart",1); 

        //second part, with the criteria for the collective marks
        $collectivemarks=$program->block->where("programpart",2); 

        //errors made by the rider, aka deductions
        $error=$result->error; 

        // bool: is the rider eliminated?
        $eliminated=$result->eliminated; 


        return view("result.normal.show",[ "result"=>$result, 
                                    "program"=>$program,
                                    "start"=>$start,
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
        return view("result.normal.edit",[ "result"=>$result,
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

        //calculcate, the collective marks, the second part of the program, used to break up ties
        $collectivemark=$this->collectiveMarkPoint($result,$array,$data["error"]);

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
    private function collectiveMarkPoint(Result $result, array $pointArray, float $error){
        //-1 means elimination: return 0
        if ($error==-1) return 0;

        $point=0;

        //the blocks of only the second part, contains the ordinal of the given block
        $blocks=$result->start->event->program->block->where("programpart","2");
        
        foreach ($blocks as $block){
            //the ordinal of the approriate block ZERO INDEX!
            $ordinal=$block["ordinal"]-1;
            $point+=$pointArray[$ordinal]["mark"]*$block["coefficient"];
        }
    
        return $point;
    }
    private function calculateError(Program $program, float $mark, float $error){
        if ($error==0) return 0;
        if ($program->errortype==1) return $error;

        if ($program->errortype==2) 
        {
            if ($error==2) return $this->calculatePercentagePoint($mark,$program->maxMark,0.5);
            if ($error==6) return $this->calculatePercentagePoint($mark,$program->maxMark,1);
        }

    }

    private function calculatePercentagePoint(float $mark, float $maxMark, float $deduction){
        $percent=($mark/$maxMark)-($deduction/100.0);
        return $mark-($maxMark*$percent);
    }
}
