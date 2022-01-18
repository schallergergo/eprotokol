<?php

namespace App\Http\Controllers;

use App\Models\Start;
use App\Models\Event;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ResultExport;
use App\Imports\ResultImport;
use Illuminate\Database\Eloquent\Collection;

class StartController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::User()->role=="penciler") return;
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
            'id' => $this->generateID(),
            'event_id' => $event->id,
            'rider_id'=> $data['rider_id'],
            'rider_name'=> $data['rider_name'],
            'horse_id'=> $data['horse_id'],
            'horse_name'=> $data['horse_name'],
            'club' => $data['club'],
            'category' => $data['category'],
            'rank'=> $lastRank,
        ]);

        $this->addResultEntries($newStart);

        return redirect("event/show/{$event->id}");
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
            ]);


        $start->update($dataOut);
        return redirect("/event/show/{$start->event->id}");
        
    }
    public function destroy(Start $start){
        $this->authorize('delete', $start );
        $resultController = new ResultController();
        foreach($start->result as $result){
            $resultController->destroy($result);
        } 
        $start->delete();
        return redirect("event/show/{$start->event->id}");
    }

    public function import(Event $event){
        $this->authorize('create', [Start::class,$event]);
         $data = request();
        $data=$data->validate([
            'upload' => ['required','file','mimes:xlsx' ],
            ]);

        $out=[];

        
        //dd($data["upload"]->path().".xlsx");
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

    public function calculateAllJudges(Start $start){
        $officials=$start->event->official;

        $completedResults=Result::where("start_id",$start->id)
            ->where("completed",">",0)->get();
        if (count($officials)==count($completedResults)){

            $this->markAverage($start,$completedResults);
            $this->calculateRank($start);
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
    private function calculateRank(Start $start){
        
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
   private function generateID(){

        //lower limit of the id
        $limit = 10000000000000000;

        //generating a random id
        $id = rand($limit,$limit*10);

        //checking if a record already exisits with the given id
        $result = Start::find($id);

        // iterating the last two steps until id is found
        while ($result!==null){
            $id = rand($limit,$limit*10);
            $result = Result::withTrashed()->find($id);
        }

        return $id;
    }

}
