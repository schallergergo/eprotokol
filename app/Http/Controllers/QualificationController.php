<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\QualificationExport;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Start;
use App\Models\Event;

class QualificationController extends Controller
{
        public function qualificationSettings(){
        $data=request();
        $discipline=$data["discipline"];
        $programs=Program::where("discipline",$discipline)->orderBy("ordinal")->get();

        return view("qualification.settings",
            [
               "programs"=>$programs,
               "discipline"=>$discipline
            ]);
    }


    public function qualificationShow(){

        $data=request();

        $excel=isset($data->download);

        $data=$data->validate([
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'programs' => ['required'],
            'percent' => ['required', 'integer', 'min:0'],
            'amount' =>['required', 'integer', 'min:1'],
            ]);
        $events=Event::whereIn("program_id",$data["programs"])->
                where("created_at",">=",$data["start"])->
                where("created_at","<=",$data["end"])->get();

        $starts=collect([]);
        foreach($events as $event){

            $temp=$event->start->where("percent",">=",$data["percent"]);

            $starts=$starts->merge($temp);


        };
        $starts=$starts->unique("rider_id")->sortBy("rider_name");
        if (count($starts)==0) return __("Nothing found!");
        //       return redirect(route("qualification.settings"))->with("status",__("Nothing found!"));
        if ($excel) return Excel::download(new QualificationExport($starts), 'qualification.xlsx');
        else return view("qualification.show",["starts"=>$starts]);
    }

    
}
