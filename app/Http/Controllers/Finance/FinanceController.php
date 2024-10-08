<?php







namespace App\Http\Controllers\Finance;



use App\Models\Competition;



use App\Models\StartFee;



use App\Models\BoxFee;



use App\Models\EntryFee;



use App\Models\Start;



use App\Models\Transaction;



use App\Http\Controllers\Controller;



use Illuminate\Http\Request;



use Illuminate\Support\Facades\DB;







class FinanceController extends Controller



{



    public function show(Competition $competition){







        $this->authorize("update",$competition);

        
        $ids = $events = $this->getEventIds($competition);



        $clubs = Start::whereIn("event_id",$ids)->orderBy("club")->select("club")->distinct()->get();


        $clubsArray = [];
        $totalStartFee = 0;
        $totalBoxFee = 0;

        foreach($clubs as $club)
        {   
            $club_name = $club->club;
            $start_fee = collect($this->getStartfeeByClub($competition, $club_name))->where("paid",1)->sum("amount");
            $box_fee = $this->getBoxFeeAmountByClub($competition, $club_name);
            $clubsArray[] = 
                [
                "club_name"=>$club_name,
                "start_fee"=>$start_fee,
                "box_fee" => $box_fee,

                ];

            $totalBoxFee += $box_fee;
            $totalStartFee += $start_fee;
        }



        return view("finance.show",[
            "competition"=>$competition,
            "clubsArray"=>$clubsArray,
            "totalBoxFee"=>$totalBoxFee,
            "totalStartFee"=>$totalStartFee
        ]);



        

    }


    private function getBoxFeeAmountByClub(Competition $competition, string $club){

        return BoxFee::where("competition_id",$competition->id)->where("club",$club)->where('paid',1)->sum("amount");
    }

    private function getStartFeeByClub(Competition $competition, string $club){
        



        $records = DB::table('start_fees')->select(

"start_fees.id",

"start_fees.start_id",

"start_fees.transaction_id",

"start_fees.competition_id",

"start_fees.amount",

"start_fees.paid",

"start_fees.created_at",    

"start_fees.updated_at")



    ->join('starts', 'starts.id', '=', 'start_fees.start_id')



    ->join("events","events.id",'=',"starts.event_id")



    ->join("competitions","competitions.id","=","events.competition_id")



    ->where('starts.club',$club)



    ->where('competitions.id',$competition->id)



    ->orderBy("starts.club")



    ->orderBy("rider_name")



    ->get();

    



     $start_fees = [];





    foreach ($records as $record) {



    $model = new StartFee();



    $model->fill((array)$record);



    $start_fees[] = $model;



}   

    return $start_fees;
    }





    public function filterByClub(Competition $competition, $club)



    {



        $this->authorize("update",$competition);

        $start_fees = $this->getStartfeeByClub($competition, $club);

        $box_fees = $competition->box_fee->where("club",$club)->where('paid',1);
        return view("finance.filter",
            ["competition"=>$competition,
            "start_fees"=>$start_fees,
            "box_fees"=>$box_fees,
            "filterTerm"=>$club
        ]);



    



}



    public function didNotPay(Competition $competition)



    {



        $this->authorize("update",$competition);



        $records = DB::table('start_fees')->select(

"start_fees.id",

"start_fees.start_id",

"start_fees.transaction_id",

"start_fees.competition_id",

"start_fees.amount",

"start_fees.paid",

"start_fees.created_at",	

"start_fees.updated_at")



    ->join('starts', 'starts.id', '=', 'start_fees.start_id')



    ->join("events","events.id",'=',"starts.event_id")



    ->join("competitions","competitions.id","=","events.competition_id")



    ->where('start_fees.paid',0)



    ->where('competitions.id',$competition->id)



    ->orderBy("starts.club")



    ->orderBy("rider_name")



    ->get();







    $start_fees = [];



    foreach ($records as $record) {



    $model = new StartFee();



    $model->fill((array)$record);



    $start_fees[] = $model;



}











        return view("finance.filter",["competition"=>$competition,"start_fees"=>$start_fees,"filterTerm"=>""]);



    }







    public function filterByRider(Competition $competition, $rider_id)



    {



        $this->authorize("update",$competition);



        $ids = $events = $this->getEventIds($competition);



        $start_ids = Start::whereIn("event_id",$ids)->where("rider_id",$rider_id)->orderBy("rider_name")->pluck("id");



        $start_fees = StartFee::whereIn("start_id",$start_ids)->get();



        dd($start_fees);



    }











    private function getEventIds(Competition $competition){



    return $competition->event->pluck("id");



    }







   



}



