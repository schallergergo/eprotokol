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
        $start_fees = StartFee::whereIn("start_id",$start_ids)->orderBy("paid")->get();
        return view("finance.filter",["competition"=>$competition,"start_fees"=>$start_fees,"filterTerm"=>$club]);
    }

    public function didNotPay(Competition $competition)
    {
        $this->authorize("update",$competition);
        $ids = $events = $this->getEventIds($competition);
        $start_fees = StartFee::where("competition_id",$competition->id)->where("paid",0)->get();
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
