<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = request();

        if (!isset($data["discipline"])) return view("program.index",["discipline"=>""]);
        $data=$data->validate([
            'discipline' => [],
            ]);

        $programs=Program::where("discipline",$data["discipline"])->where('active',1)->get();

        return view("program.index",["programs"=>$programs,
                                    "discipline"=>$data["discipline"]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('program.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProgramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramRequest $request)
    {


        $data=$request->validated();


        


        $program=\App\Models\Program::create([
            'discipline' => $data['discipline'],
            'name' => $data['name'],
            'numofblocks' => $data['numofblocks'],
            'maxMark' => $data['maxMark'],
            'typeofevent' => $data['typeofevent'],
            'doublesided' => $data['doublesided'],
        ]);

        
        return redirect("/block/create/{$program->id}");
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        $blocks=$program->block->where("programpart",1);
        $collectivemarks=$program->block->where("programpart",2);
        return view('program.show',[
            "program"=>$program,
            "blocks"=>$blocks,
            "collectivemarks"=>$collectivemarks
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
         return view("program.edit",["program"=>$program]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramRequest  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {

        $data=$request->validated();

        $program->update($data);
        return redirect("program/index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        //
    }
}
