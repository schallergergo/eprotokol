<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Start;

class StartDataController extends Controller
{
    
    public function getRiderData(){
        
        $riders = Start::orderBy("rider_name")->select("rider_id","rider_name","club")->distinct()->get();
        return json_encode($riders);

    }


    public function getHorseData($club){
        $horses = Start::where("club","LIKE","%".$club."%")->orderBy("horse_name")->select("horse_id","horse_name")->distinct()->get();
        return json_encode($horses);
    }
}
