<?php
namespace App\Exports\Kondor;
use Illuminate\Http\Request;
use App\Models\Start;
use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromArray;
class StyleExport implements FromArray {
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
        $starts = Start::where('event_id', $this->event->id)->orderBy("updated_at")->get();
        $output = [];
        $output[]=$this->head();;
        foreach ($starts as $start) {
                $temp=[];
                $style = $start->style->first();

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

                $temp[] = "".$style->total_fault;
                $temp[] = "".$style->time;
                $temp[] = "".$style->given_mark;
                $temp[] = "".$style->deductions;
                $temp[] = "".$style->total_mark;
                $temp[] = "".$start->updated_at;



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

                $temp[] = "total fault";
                $temp[] = "time";

                $temp[] = "given mark";
                $temp[] = "deductions";
                $temp[] = "total mark";
                $temp[] = "updated_at";



        return $temp;
         }
}