<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Start;
use App\Models\TeamMember;
use App\Models\Championship;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Championship $championship)
    {
        $this->authorize("create",[Team::class,$championship]);
        $teams = $championship->team;
        return view("team.index",["championship"=>$championship,"teams"=>$teams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Championship $championship)
    {
        $this->authorize("create",[Team::class,$championship]);
        return view("team.create",["championship"=>$championship]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request,Championship $championship)
    {
        $this->authorize("create",[Team::class,$championship]);

        $data = $request->validated();




        $newTeam = Team::create([
                            "name"=>$data["name"],
                            "championship_id"=>$championship->id,
                                ]);


        $riders =$data["rider"];
        $horses =$data["horse"];
        
        for($i=0;$i<3;$i++){

            $horse = $horses[$i];

            $rider = $riders[$i];


            $rider_name = Start::where("rider_id",$rider)->limit(1)->pluck("rider_name");
            $rider_name = count($rider_name)>0 ? $rider_name[0] : "No name";


            $horse_name = Start::where("horse_id",$horse)->limit(1)->pluck("horse_name");
            $horse_name = count($horse_name)>0 ? $horse_name[0] : "No name";
            if ($rider!=null && $horse!=null){
                TeamMember::create(
                    [
                    "rider_id"=>$rider,
                    "horse_id"=>$horse,
                    "rider_name"=>$rider_name,
                    "horse_name"=>$horse_name,
                    "team_id"=>$newTeam->id,
                    "twoIds"=>$rider."".$horse,
                    ]);
            }
        }


        return redirect("team/index/".$championship->id);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $this->authorize("update",$team);

        return view("team.edit",["team"=>$team]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeamRequest  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $this->authorize("update",$team);

        $data = $request->validated();

        $team->update($data);

        return redirect("/team/index/".$team->championship->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {   
        $this->authorize("delete",$team);
        $championship = $team->championship;
        foreach($team->team_member as $member){
            $member->delete();
        }
        $team->delete();
        return redirect("/team/index/".$championship->id);
    }
}
