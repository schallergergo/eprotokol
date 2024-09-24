<?php



namespace App\Http\Controllers;



use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\JumpingQualificationExport;

use Illuminate\Http\Request;

use App\Models\Program;

use App\Models\Start;

use App\Models\Event;
use Illuminate\Support\Facades\DB;


class JumpingQualificationController extends Controller

{
    
     public function qualificationShow(){
        $advanced = DB::table('advanced')->get("rider_id");
        //dd($advanced->where("rider_id",14378));
        $arr = $this->getArray();
        return view("qualification.jumping",[
            "elokezdok"=>$arr["elokezdoStilus"],
            "kezdok"=>$arr["kezdo"],
            "haladostilus"=>$arr["haladoStilus"],
            "haladok"=>$arr["halado"]
        ]);
     }


     public function qualificationExcel(){
        $arr = $this->getArray();
        $collection = collect([

            ["name"=>"elokezdo","data"=>$arr["elokezdoStilus"]],
            ["name"=>"kezdo","data"=>$arr["kezdo"]],
            ["name"=>"haladostilus","data"=>$arr["haladoStilus"]],
            ["name"=>"halado","data"=>$arr["halado"]]

            ]);
        return Excel::download(new JumpingQualificationExport($collection), 'jumping_qualification.xlsx');
     }


    public function getArray(){

        $allStarts = collect();
        $startDate ="2023.10.01";

        $caprilli_events = Event::where("created_at",">",$startDate)->whereIn("program_id",[74,75,76])->get();
        $caprilli_ids = $caprilli_events->pluck("id");
        $caprilli_starts = Start::whereIn("event_id",$caprilli_ids)->where("percent",">=",60)->get();
        $allStarts = $allStarts->merge($caprilli_starts);



        $pk1_events = Event::where("created_at",">",$startDate)->where("program_id",69)->get();
        $pk1_ids = $pk1_events->pluck("id");
        $pk1_starts = Start::whereIn("event_id",$pk1_ids)->where("percent",">=",60)->get();
        $allStarts = $allStarts->merge($pk1_starts);


        $pk2_events = Event::where("created_at",">",$startDate)->where("program_id",70)->get();
        $pk2_ids = $pk2_events->pluck("id");
        $pk2_starts = Start::whereIn("event_id",$pk2_ids)->where("eliminated",0)->get();
        $allStarts = $allStarts->merge($pk2_starts);



        $pk3_events = Event::where("created_at",">",$startDate)->where("program_id",71)->get();
        $pk3_ids = $pk3_events->pluck("id");
        $pk3_starts = Start::whereIn("event_id",$pk3_ids)->where("eliminated",0)->get();
        $allStarts = $allStarts->merge($pk3_starts);


        $riders = $allStarts->unique("rider_id")->pluck("rider_id");

        $rider_array = array();
        
        
        foreach ($riders as $rider){
            $pk1_temp = $pk1_starts->where("rider_id",$rider);
            $pk2_temp = $pk2_starts->where("rider_id",$rider);
            $a = collect($pk1_temp)->filter(function ($item)  {
            // replace stristr with your choice of matching function
            return false !== stristr($item->category, "alad");
            });
            $rider_array[] = [
                "rider_id"=>$rider,
                "advanced" => count($a)>0,
                "caprilli" => count($caprilli_starts->where("rider_id",$rider)),
                "style" =>  count($pk1_temp),
                "pk2_finished" => count($pk2_temp),
                "pk2_nofaults" => count($pk2_temp->where("mark",0)),
                "pk3_finished" => count($pk3_starts->where("rider_id",$rider))

            ]; 
        }
    

    $qualification_array = array();

        $elokezdoStilus =[];
        $haladoStilus = [];
        $kezdo = [];
        $halado = [];

    foreach($rider_array as $rider){
        $kezdo_temp =  $this->kezdoMinosult($rider);
        $halado_temp =  $this->haladoMinosult($rider);
        $arr_temp = ["start"=>$allStarts->where("rider_id",$rider["rider_id"])->first(),"rider_array"=>$rider];



            
            if (!$kezdo_temp && !$halado_temp && $rider["style"]>0 ) $elokezdoStilus[] = $arr_temp;
            if ($kezdo_temp) $kezdo[] = $arr_temp;
            if (!$halado_temp && $rider["advanced"]  && $rider["style"]>0)  $haladoStilus[] = $arr_temp;
            if ($halado_temp) $halado[] = $arr_temp;

    }
        return ["elokezdoStilus"=>$elokezdoStilus,
            "kezdo"=>$kezdo,
            "haladoStilus"=>$haladoStilus,
            "halado"=>$halado];
    }



private  function kezdoMinosult($rider){
    if ($rider["advanced"]) return false;
    if ($rider["caprilli"] + $rider["style"]>0 &&
        $rider["pk2_finished"]>0) return true;
    if ( $rider["pk2_finished"]>0 &&
        $rider["pk3_finished"]>0) return true;
    if ($rider["pk2_finished"]>1) return true;
    return false;
}

private  function haladoMinosult($rider){

    if ( $rider["pk2_finished"]>0 &&
        $rider["pk3_finished"]>0) return true;
    if ($rider["pk2_nofaults"]>1) return true;
    if ($rider["pk3_finished"]>1) return true;
    return false;
}

}