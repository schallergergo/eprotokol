<?php
namespace App\Exports;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Start;
use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromArray;
class QualificationExport implements FromArray {
    private Collection $starts;

    public function __construct(Collection $starts) 
    {
        $this->starts=$starts;
    }
    
    public function array() :array
        
    {  
    	 return $this->makeArray();
 

    }
    private function makeArray() {

        $output = [];
    	$output[]=$this->head();

    	foreach ($this->starts as $start) {

                $temp=[];
                $temp[] = $start->rider_id;
                $temp[] = $start->rider_name;
                $temp[] = $start->horse_id;
                $temp[] = $start->horse_name;
                $temp[] = $start->club;
                $temp[] = $start->original_category;
                $temp[] = $start->mark;
                $temp[] = $start->percent;
                $temp[] = $start->collective;
                
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
       
                $temp[] = "total mark";
                $temp[] = "total percent";
                $temp[] = "total collective";
                return $temp;
         }
}