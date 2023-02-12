<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Start;
class SearchController extends Controller
{
    public function show(){
        $data = request();

        if (!isset($data["search"])) return view("result.search",["search"=>""]);
        $data=$data->validate([
            'search' => [],
            ]);
        $searchTerm=$data["search"];
        $starts=Start::where("completed",">",0)
                ->where(function($query) use ($searchTerm){
                    $query->where("rider_name","LIKE","%".$searchTerm."%")
                            ->orWhere("rider_id",$searchTerm)
                            ->orWhere("horse_id",$searchTerm)
                            ->orWhere("horse_name","LIKE","%".$searchTerm."%");})
                ->orderBy("rider_name")
                ->orderBy("created_at","desc")
                ->get();

        return view("result.search",["starts"=>$starts,"search"=>$searchTerm]);
    }
}
