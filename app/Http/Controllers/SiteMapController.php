<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Competition;
use App\Models\Program;
use App\Models\Start;

class SiteMapController extends Controller
{
    public function generate(){
         
    $xml='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    $xml=$xml.$this->url("",1.0,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->url("register",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->url("login",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->url("competition/index",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->url("program/index",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->url("program/index?discipline=poniklub",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->url("program/index?discipline=dijlovas",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->url("program/index?discipline=lovastusa",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->url("search",0.8,"2022-02-24T09:12:39+00:00");
    $xml=$xml.$this->generateCompetitions();
    $xml=$xml.$this->generateEvents();
    $xml=$xml.$this->generatePrograms();
    $xml=$xml.$this->generateRiders();
   $xml=$xml."</urlset>";

   return response($xml, 200)->header('Content-Type', 'application/xml');
}
private function generateRiders(){
    $starts = Start::select('rider_id')->distinct()->get();
    $xml="";
    foreach ($starts as $start) $xml=$xml.$this->url("result/search?search=".$start->rider_id,0.6,"2022-02-24T09:12:39+00:00");
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
    $programs=Program::all();
    $xml="";
    foreach ($programs as $program) $xml=$xml.$this->url("program/show/".$program->id,0.6,$program->updated_at);
    return $xml;
}
private function url($name, $priority,$modified){
    return "<url>
    <loc>https://eprotokol.hu/".$name."</loc>
    <lastmod>".$modified."</lastmod>
    <priority>".$priority."</priority>
    </url>";
}
}


