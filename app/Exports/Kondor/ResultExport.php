<?php

namespace App\Exports\Kondor;

use Illuminate\Http\Request;

use App\Models\Start;

use App\Models\Event;

use Maatwebsite\Excel\Concerns\FromArray;

class ResultExport implements FromArray {

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

        $output[]=$this->head(count($this->event->official));;

        foreach ($starts as $start) {

                $temp=[];

                if ($start->completed){

                     $temp[] = $start->rank;

                }

                else  $temp[] = "";

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

                $temp[] = $start->mark;

                $temp[] = $start->percent;

                $temp[] = $start->collective;

                

                $output[]=$temp;

        

    

            }

        return $output;

        }



        private function head($numOfStarts){

                $temp   = [];

                $temp[] = "rank";

                $temp[] = "rider_id";

                $temp[] = "rider_name";

                $temp[] = "horse_id";

                $temp[] = "horse_name";

                $temp[] = "club";

                $temp[] = "category";

                $temp[] = "empty";

                $temp[] = "total mark";

                $temp[] = "total percent";

                $temp[] = "total collective";

                return $temp;

         }

}