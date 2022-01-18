<?php
namespace App\Exports;
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
    	$starts= Start::where('event_id', $this->event->id)->get();
        
    	$output=[];
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
                $temp[] = $start->category;
                foreach ($start->result as $result){
                    foreach (json_decode($result->assessment) as $assessment)
                    {

                        $temp[] =$assessment->mark;
                    }
                    $temp[] = $result->mark;
                    $temp[] = $result->percent;
                    $temp[] = $result->collective;
                    $temp[] = $result->error;
                }
                $temp[] = $start->mark;
                $temp[] = $start->percent;
                $temp[] = $start->collective;
                
                $output[]=$temp;
        
    
            }
return $output;
        }
}