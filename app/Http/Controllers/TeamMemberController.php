<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\Team;
use App\Models\Start;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamMemberRequest;
use App\Http\Requests\UpdateTeamMemberRequest;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        $this->authorize("create",[TeamMember::class,$team]);
        $member_count = count($team->team_member);
        return view("team_member.create",["team"=>$team,"memberCount"=>$member_count]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeamMemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamMemberRequest $request, Team $team)
    {
        $this->authorize("create",[TeamMember::class,$team]);
        if (count($team->team_member)>2) return redirect("/team/index/".$team->championship->id);
        $data = $request->validated();

        $riders =$data["rider"];
        $horses =$data["horse"];
        for($i=0;$i<count($horses);$i++){

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
                    "team_id"=>$team->id,
                    "twoIds"=>$rider."".$horse,
                    ]);
            }
            
    }
    return redirect("/team/index/".$team->championship->id);
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teamMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teamMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeamMemberRequest  $request
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamMemberRequest $request, TeamMember $teamMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamMember $teamMember)
    {   
        $this->authorize("delete",$teamMember);
        $id = $teamMember->team->championship->id;

        $teamMember->delete();

        return redirect("/team/index/".$id);
    }
}
