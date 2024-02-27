<?php
namespace App\Exports\Kondor;
use Illuminate\Http\Request;
use App\Models\Start;
use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromArray;
class JumpingRoundExport implements FromArray {
    private Event $event;

    public function __construct(Event $event) 
    {
        $this->event=$event;
    }

    public function array() :array

    {  
         return $this->makeArray();


    }
    private function makeArray() {
        $starts = Start::where('event_id', $this->event->id)->get();
        $output = [];
        $output[]=$this->head();;
        foreach ($starts as $start) {
                $temp=[];
                $round = $start->jumping_round->first();

                $temp[] = $start->rider_id;
                $temp[] = $start->rider_name;
                $temp[] = $start->horse_id;
                $temp[] = $start->horse_name;
                $temp[] = $start->club;
                $temp[] = $start->original_category;
                $temp[] = "";
                if ($start->completed){
                     $temp[] = $start->rank;
                }
                else  $temp[] = "";
                $temp[] = "".$round->total_fault1;
                $temp[] = "".$round->time1;

                $temp[] = "".$round->total_fault2;
                $temp[] = "".$round->time2;
                $output[]=$temp;


            }
        return $output;
        }

        private function head(){
                $temp   = [];
                
                $temp[] = "rider_id";
                $temp[] = "rider_name";
                $temp[] = "horse_id";
                $temp[] = "horse_name";
                $temp[] = "club";
                $temp[] = "category";
                $temp[] = "empty";
                $temp[] = "rank";
                $temp[] = "total fault 1. round";
                $temp[] = "time 1. round";
                $temp[] = "total fault 2. round";
                $temp[] = "time 2. round";


        return $temp;
         }
}