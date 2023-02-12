<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors=Sponsor::paginate(40);
        return view("sponsor.index",[
            "sponsors"=>$sponsors,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("sponsor.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSponsorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsorRequest $request)
    {
        $data=request();
        $logo=Storage::put("sponsor",$data["logo"]);
        //dd(Storage::disk("public")->url($logo));
        $newSponsor=\App\Models\Sponsor::create([
           
            'name' => $data["sponsor_name"],
            'logo_url' => "/storage/app/".$logo,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSponsorRequest  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsorRequest $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
       $id = $sponsor->id;
       if ($id==1) abort(403);
       $events=Event::where("sponsor_id",$id)->update(["sponsor_id"=> 1]);
       $sponsor->delete();
       return redirect()->back();
    } 
}
