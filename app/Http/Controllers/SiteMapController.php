<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Competition;
use App\Models\Championship;
use App\Models\Program;
use App\Models\Start;

class SiteMapController extends Controller
{
    public function generate(){

    $xml='<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    $xml=$xml.$this->url("",1.0,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->url("register",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->url("login",0.8,"2022-02-24T09:12:39+00:00");
        $xml=$xml.$this->url("contact",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->generateIndex();
    $xml=$xml.$this->generateProgramIndex("");
    $xml=$xml.$this->generateProgramIndex("?discipline=poniklub");
    $xml=$xml.$this->generateProgramIndex("?discipline=dijlovas");
    $xml=$xml.$this->generateProgramIndex("?discipline=lovastusa");
    $xml=$xml.$this->url("result/search",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->generateCompetitions();
    $xml=$xml.$this->generateEvents();
    $xml=$xml.$this->generateChampionships();
    $xml=$xml.$this->generatePrograms();
    $xml=$xml.$this->generateRiders();
    $xml=$xml.$this->generateHorses();


   
   $xml=$xml."</urlset>";

   return response($xml, 200)->header('Content-Type', 'application/xml');
}
private function generateIndex(){
    $xml="";
    $xml.=$this->url("competition/index",0.6,"2022-02-24T09:12:39+00:00");
    $xml.=$this->url("championship/index",0.6,"2022-02-24T09:12:39+00:00");

    return $xml;
}

private function generateProgramIndex(string $discipline){
    $program=Program::orderByDesc("created_at")->first();
    $xml=$this->url("program/index".$discipline,0.6,$program->created_at);
    return $xml;
}
private function generateRiders(){
    $starts = Start::where("completed",1)->select('rider_id')->distinct()->get();
    $xml="";
    foreach ($starts as $start) $xml=$xml.$this->url("result/search?search=".$start->rider_id,0.6,"2022-02-24T09:12:39+00:00");
    return $xml;
}

private function generateHorses(){
    $starts = Start::where("completed",1)->select('horse_id')->distinct()->get();
    $xml="";
    foreach ($starts as $start) $xml=$xml.$this->url("result/search?search=".$start->horse_id,0.6,"2022-02-24T09:12:39+00:00");
    return $xml;
}
private function generateCompetitions(){
    $competitions=Competition::all();
    $xml="";
    foreach ($competitions as $competition) $xml=$xml.$this->url("competition/show/".$competition->id,0.6,$competition->updated_at);
    return $xml;
}

private function generateEvents(){
    $events=Event::all();
    $xml="";
    foreach ($events as $event) $xml=$xml.$this->url("event/show/".$event->id,0.6,$event->updated_at);
    return $xml;
}
private function generatePrograms(){
    $programs=Program::where('active',1)->get();
    $xml="";
    foreach ($programs as $program) $xml=$xml.$this->url("program/show/".$program->id,0.6,$program->updated_at);
    return $xml;
}
private function generateChampionships(){
    $championships = Championship::all();
    $xml="";
    foreach ($championships as $championship) $xml=$xml.$this->url("championship/show/".$championship->id,0.6,"2022-02-24T09:12:39+00:00");
    return $xml;
}
private function url($name, $priority,$modified){
    $date = date_create($modified);

    return "<url>
    <loc>https://www.eprotokol.hu/".$name."</loc>
    </url>";
}
}


