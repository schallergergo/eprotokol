<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Start;
use App\Models\Event;
use App\Models\Competition;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {$user=Auth::User();
        if ($user->role=="rider") return $this->riderIndex($user);
        if ($user->role=="office") return $this->officeIndex($user);
         if ($user->role=="penciler") return $this->pencilerIndex($user);
        /*
        
        if ($user->role=="admin") return $this->adminIndex($user);
       
        */
        return view("home");
    }

    //the home screen for riders
    private function riderIndex(User $user){
        $toMatch=[
            "rider_id"=>$user->username,
            "completed"=>1,
            "public"=>1,
            ];
        $starts=Start::where($toMatch)->orderBy('created_at','desc')->paginate(10); 
        //dd($starts);
        return view("start.rider.index",["starts"=>$starts]);
    }


    private function officeIndex(User $user){
        $toMatch=[
            "office"=>$user->id,

            ];
        $competitions=Competition::where($toMatch)->orderBy('date','desc')->paginate(10); 
        return view("competition.index",["competitions"=>$competitions]);
    }
    public function pencilerIndex(User $user){

        

   $events= DB::table('events')
            ->join('competitions', 'events.competition_id', '=', 'competitions.id')
            ->join('officials', 'officials.event_id', '=', 'events.id')
            ->where("competitions.active",1)
            ->where("officials.penciler",$user->id)
            ->select('events.event_name',
                     'events.id', 
                     'competitions.name',
                     'competitions.date',
                    'competitions.venue')
            ->paginate(30);
            //dd($events);



        return view("event.index",["events"=>$events]);
    }


    private function adminIndex(User $user){
        $events=Event::orderBy('date','desc')->paginate(10); 
        return view("event.index",["events"=>$events]);
    }
}