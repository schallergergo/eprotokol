<?php

namespace App\Http\Controllers;

use App\Models\Start;
use App\Models\Event;
use App\Models\Result;
use App\Models\Program;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\JumpingRoundController;
use App\Http\Controllers\StyleController;
use App\Mail\ResultMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ResultImport;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;


class StartController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(User $user)
    {
        $this->authorize('viewAny', [Start::class,$user]);
        $starts=Start::where("rider_id",$user->username)->where("completed",">","0")->orderByDesc("created_at")->paginate(20);
        return view("start.rider.index",["starts"=>$starts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        $this->authorize('create', [Start::class,$event]);
        $event_id=$event->id;
        return view("start.create",["event"=>$event]);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event)
    {

        $this->authorize('create', [Start::class,$event]);
        $data = request();

        //validation rules

        $data=$data->validate([
            'rider_id' => ['required', 'string', 'max:6'],
            'rider_name' => ['required', 'string', 'max:255'],
            'horse_id' => ['required', 'string', 'max:6'],
            'horse_name' => ['required', 'string', 'max:255'],
            'club' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string',  'max:255'],
            ]);

        
        $results=new ResultController();
        
        $lastRank=$this->getLastRank($event);

        $newStart=\App\Models\Start::create([
            'id' => strval($this->generateID()),
            'event_id' => $event->id,
            'rider_id'=> $data['rider_id'],
            'rider_name'=> $data['rider_name'],
            'horse_id'=> $data['horse_id'],
            'horse_name'=> $data['horse_name'],
            'club' => $data['club'],
            'category' => $data['category'],
            'original_category' => $data['category'],
            'rank'=> $lastRank,
            'twoids'=>$data["rider_id"].$data["horse_id"],
        ]);

        if ($event->program->has_result) $this->addResultEntries($newStart);
        $this->addToExtraTables($newStart);

        return redirect("event/show/{$event->id}");
    }


    public function addToExtraTables(Start $newStart){
        $typeofevent=$newStart->event->program->typeofevent;
        $jumpingRound= new JumpingRoundController();
        switch ($typeofevent) {
            case "pkx":

                $jumpingRound->createRound($newStart);
                break;
            case "rounds":

                $jumpingRound->createRound($newStart);
                break;

                
            case "style":
                $style= new StyleController();
                $style->createStyle($newStart);
                break;

}
    }
    public function addResultEntries(Start $start){

        $resultsController=new ResultController();
        foreach($start->event->official as $official)
            $resultsController->store($start,$official);   
    }

    public function notCompleted(Start $start){

        $this->authorize('update', $start );
         $data=[
            
            'completed'=>0, 
            ];
        $start->update($data);
      
    }
   private function getLastRank(Event $event){
    $lastRank= Start::where('event_id',$event->id)->max("rank");
    if ($lastRank==null) return 1;
    return $lastRank+1;
   }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Start  $start
     * @return \Illuminate\Http\Response
     */
   public function edit (Start $start){
        $this->authorize('update', $start );
        return view("start.edit",
            [
               "start"=>$start
            ]);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Start  $start
     * @return \Illuminate\Http\Response
     */
    public function update(Start $start){
        $this->authorize('update', $start );
        $data = request();
       
        $dataOut=$data->validate([
            'rider_id' => ['required', 'string', 'max:6'],
            'rider_name' => ['required', 'string', 'max:255'],
            'horse_id' => ['required', 'string', 'max:6'],
            'horse_name' => ['required', 'string', 'max:255'],
            'club' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string',  'max:255'],
            'original_category' => ['required', 'string',  'max:255'],
            ]);


        $start->update($dataOut);
        $start->twoIds=$data["rider_id"].$data["horse_id"];
        $start->save();
        $this->calculateAllRank($start);
        return redirect("/event/show/{$start->event->id}");
        
    }

    public function destroy(Start $start){
        $this->authorize('delete', $start );
        $resultController = new ResultController();
        foreach($start->result as $result){
            $resultController->destroy($result);
        } 
        $roundController = new JumpingRoundController();
        foreach($start->jumping_round as $round){
            $roundController->destroy($round);
        } 
        $start->delete();
        return redirect("event/show/{$start->event->id}");
    }

     public function restore($id){

        $start  = Start::onlyTrashed()->where("id",$id)->first();

        $this->authorize('restore', $start );
        $resultController = new ResultController();
        $results = Result::onlyTrashed()->where("start_id",$start->id)->get();
        foreach($results as $result){
            $resultController->restore($result);
        } 
        $roundController = new JumpingRoundController();

        foreach($start->jumping_round as $round){
            $roundController->destroy($round);
        } 
        $start->restore();
        return redirect("event/show/{$start->event->id}");
    }

    public function import(Event $event){
        $this->authorize('create', [Start::class,$event]);
         $data = request();
        $data=$data->validate([
            'upload' => ['required','file','mimes:xlsx' ],
            ]);

        $out=[];

        
        try{
          $import = new ResultImport($event);

        $import->import($data["upload"]->path(), null, \Maatwebsite\Excel\Excel::XLSX);

        $error=$import->errors();

        if (count($error)==0)return redirect("event/edit/{$event->id}")->with("status","Successfully imported! ");

        else return redirect("event/edit/{$event->id}")->with("status","One of more rows skipped!");
    }
    catch (Exception $e) {
     return redirect("event/edit/{$event->id}")->with("status","Import failed!");
        }
    }

    public function compare(Start $start){

        $program = $start->event->program;
        return view("start.compare",["start"=>$start,"program"=>$program]);
    }

    public function moveUp(Start $start){
        $this->authorize('update', $start );
        $minimumRank=Start::where("event_id",$start->event_id)->min("rank");
        $rank=$start->rank-1;
        $startToSwap=Start::where("event_id",$start->event_id)->where("rank",$rank)->get();

        while($rank>$minimumRank && count($startToSwap)==0){
            $rank=$rank-1;
            $startToSwap=Start::where("event_id",$start->event_id)->where("rank",$rank)->get();
        }
        if (count($startToSwap)!=0){
            $startToSwap=$startToSwap->first();
            $temp=$start->rank;
            $start->rank=$startToSwap->rank;
            $startToSwap->rank=$temp;
            $start->save();
            $startToSwap->save();
        }
        return back();
    }

    public function moveDown(Start $start){
        $this->authorize('update', $start );
        $maximumRank=Start::where("event_id",$start->event_id)->max("rank");
        $rank=$start->rank+1;
        $startToSwap=Start::where("event_id",$start->event_id)->where("rank",$rank)->get();

        while($rank<$maximumRank && count($startToSwap)==0){
            $rank=$rank+1;
            $startToSwap=Start::where("event_id",$start->event_id)->where("rank",$rank)->get();
        }
        if (count($startToSwap)!=0){
            $startToSwap=$startToSwap->first();
            $temp=$start->rank;
            $start->rank=$startToSwap->rank;
            $startToSwap->rank=$temp;
            $start->save();
            $startToSwap->save();
        }
        return back();
    }

    

    public function calculateAllJudges(Start $start){
        $officials=$start->event->official;

        $completedResults=Result::where("start_id",$start->id) ->where("completed",">",0)->get();

            if (count($officials)==count($completedResults)){
            $completed=$start->completed;
            $this->markAverage($start,$completedResults);
            $this->calculateRank($start);
             try {
                if (env("MAIL_ACTIVE",true)) $this->sendMail($start,$completed);
            }
            
            catch (\Error $e){
                Log::channel('mail')->info($e);
        }
            catch (\Exception $e){
                Log::channel('mail')->info($e);
        }
           catch (\Throwable $e){
                Log::channel('mail')->info($e);
        }
        }
    }

    private function markAverage(Start $start, Collection $completedResults){
        $mark=$percent=$collective=0;
        foreach ($completedResults as $result){
            $mark+=$result->mark;
            $percent+=$result->percent;
            $collective+=$result->collective;
        }
        $numOfResults=count($completedResults);
        $data=[
            'mark'=>$mark/$numOfResults,
            'percent'=>$percent/$numOfResults,
            'collective'=>$collective/$numOfResults,
            'completed'=>1, 
            ];
        $start->update($data);
    }



    public function calculateAllRank(Start $start){
        
        $starts=Start::where("event_id",$start->event_id)
                            ->where("completed",1)->get();
        $starts=$starts->unique("category");

       foreach( $starts as $start) $this->calculateRank($start);
        

    }

    public function calculateRank(Start $start){
        $typeofevent = $start->event->program->typeofevent;
        if ($typeofevent=="rounds")  $this->calculateRoundRank($start);
        else if($typeofevent=="style" ) $this->calculateStyleRank($start);
        else{
        $sameCategoryStarts=Start::where("event_id",$start->event_id)
                            ->where("completed",1)
                            ->where("category",$start->category)
                            ->orderBy("mark","DESC")
                            ->orderBy("collective","DESC")->get();
        
        $numberOfStarts=count($sameCategoryStarts);
        $rankCounter=0;
        if ($numberOfStarts!==0) {
            $sameCategoryStarts[0]->rank=1;
            $sameCategoryStarts[0]->save();
        }
        for($i=1;$i<$numberOfStarts;$i++){
            $lastStart=$sameCategoryStarts[$i-1];
            $currentStart=$sameCategoryStarts[$i];
            if ($lastStart->mark!=$currentStart->mark || 
                $lastStart->collective!=$currentStart->collective){
                    $rankCounter=$i;
            }
            $currentStart->rank=$rankCounter+1;
            $currentStart->save();
        } 
        }

    }


    public function calculateRoundRank(Start $start){
            
            $sameCategoryStarts=Start::where("event_id",$start->event_id)
                            ->where("category",$start->category)
                            ->where("starts.completed",1)
                            ->join("jumping_rounds","starts.id","=","jumping_rounds.start_id")
                            ->orderByRaw("ISNULL(jumping_rounds.total_fault1), jumping_rounds.total_fault1 ASC")
                            ->orderByRaw("ISNULL(jumping_rounds.total_fault2), jumping_rounds.total_fault2 ASC")
                            ->orderByRaw("ISNULL(jumping_rounds.time2), jumping_rounds.time2 ASC")
                            ->orderByRaw("ISNULL(jumping_rounds.time1), jumping_rounds.time1 ASC")
                            ->get();
              $numberOfStarts = count($sameCategoryStarts);  
              $rankCounter=0;         
        if ($numberOfStarts!==0) {
            $start=Start::find($sameCategoryStarts[0]->start_id);
            $start->rank=1;
            $start->save();
        }
            for($i=1;$i<$numberOfStarts;$i++){
               $lastStart=$sameCategoryStarts[$i-1];
            $currentStart=$sameCategoryStarts[$i];
            if ($lastStart->total_fault1!=$currentStart->total_fault1 || 
                $lastStart->total_fault2!=$currentStart->total_fault2 || 
                $lastStart->time1!=$currentStart->time1 || 
                $lastStart->time2!=$currentStart->time2){
                    $rankCounter=$i;
                    }

            $start=Start::find($currentStart->start_id);
            $start->rank = $rankCounter+1;
            $start->save();

            } 
            

        }

    public function calculateStyleRank(Start $start){
            
            $sameCategoryStarts=Start::where("event_id",$start->event_id)
                            ->where("category",$start->category)
                            ->where("starts.completed",1)
                            ->join("styles","starts.id","=","styles.start_id")
                            ->orderByDesc("styles.total_mark")

                            ->get();
                            
        $numberOfStarts=count($sameCategoryStarts);

        $rankCounter=0;
        if ($numberOfStarts!==0) {
            $start=Start::find($sameCategoryStarts[0]->start_id);
            $start->rank=1;
            $start->save();
        }
        for($i=1;$i<$numberOfStarts;$i++){
            $lastStart=$sameCategoryStarts[$i-1];
            $currentStart=$sameCategoryStarts[$i];

            if ($lastStart->total_mark!=$currentStart->total_mark){
                    $rankCounter=$i;


            }

            $start=Start::find($currentStart->start_id);
            $start->rank = $rankCounter+1;
            $start->save();

             } 

        }



    public function calculatePKXRank(Start $start){
            
            $sameCategoryStarts=Start::where("event_id",$start->event_id)
                            ->where("category",$start->category)
                            ->where("starts.completed",1)
                            ->join("jumping_rounds","starts.id","=","jumping_rounds.start_id")
                            ->orderBy("jumping_rounds.total_fault1")

                            ->get();
                            
        $numberOfStarts=count($sameCategoryStarts);

        $rankCounter=0;
        if ($numberOfStarts!==0) {
            $start=Start::find($sameCategoryStarts[0]->start_id);
            $start->rank=1;
            $start->save();
        }
        for($i=1;$i<$numberOfStarts;$i++){
            $lastStart=$sameCategoryStarts[$i-1];
            $currentStart=$sameCategoryStarts[$i];

            if ($lastStart->total_fault1!=$currentStart->total_fault1){
                    $rankCounter=$i;


            }

            $start=Start::find($currentStart->start_id);
            $start->rank = $rankCounter+1;
            $start->save();

             } 

        }
    public function replicateStart(Event $fromEvent, Event $toEvent){

        foreach($fromEvent->start as $start){
            $newStart = $start->replicate();
            $newStart->id = $this->generateID();
            $newStart->event_id = $toEvent->id;
            $newStart->save();
            $controller = new ResultController();
            $controller->replicateResult($start,$newStart,$toEvent->official);

            $controller = new JumpingRoundController();
            $controller->replicateJumpingRound($start,$newStart);

            $controller = new StyleController();
            $controller->replicateStyle($start,$newStart);

        }


    }


   private function generateID(){

        //lower limit of the id
        $limit = 10000000000000000;

        //generating a random id
        $id = rand($limit,$limit*10);

        //checking if a record already exisits with the given id
        $result = Start::withTrashed()->find($id);

        // iterating the last two steps until id is found
        while ($result!==null){
            $id = rand($limit,$limit*10);
            $result = Result::withTrashed()->find($id);
        }

        return $id;
    }
    private function sendMail(Start $start,int $completed){
            //if ($completed>0) return;
           $user = $start->user;

           if ($user!=null){
            Mail::to($user->email)->send(new ResultMail($start));
           }
    }
}
