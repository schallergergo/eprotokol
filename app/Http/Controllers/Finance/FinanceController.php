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
        return view("finance.show",["competition"=>$competition,"clubs"=>$clubs]);
    }

    public function filterByClub(Competition $competition, $club)
    {
        $this->authorize("update",$competition);
        $ids = $events = $this->getEventIds($competition);
        $start_ids = Start::whereIn("event_id",$ids)->where("club",$club)->orderBy("rider_name")->pluck("id");
        $start_fees = StartFee::whereIn("start_id",$start_ids)->orderBy("rider_name")->orderBy("paid")->get();
        return view("finance.filter",["competition"=>$competition,"start_fees"=>$start_fees,"filterTerm"=>$club]);
    }

    public function didNotPay(Competition $competition)
    {
        $this->authorize("update",$competition);
        $records = DB::table('start_fees')
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
