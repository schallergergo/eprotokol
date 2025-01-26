<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Program;
use App\Http\Requests\StoreBlockRequest;
use App\Http\Requests\UpdateBlockRequest;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Program $program)
    {
        $ordinal=count($program->block)+1;

        return view('block.create',['program'=>$program,'ordinal'=>$ordinal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlockRequest $request,Program $program)
    {
        


        $data=$request->validated();


        $block=\App\Models\Block::create([
            'program_id'=>$program->id,
            'ordinal' => $data['ordinal'],
            'programpart' => $data['programpart'],
            'letters'=> $data['letters'],
            'criteria'=> $data['criteria'],
            'extra_info'=>$data["extra_info"],
            'maxmark' => $data['maxmark'],
            'coefficient' => $data['coefficient'],
        ]);

        
        return redirect("/block/create/{$program->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
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
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        return view("block.edit",["block"=>$block]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlockRequest  $request
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlockRequest $request, Block $block)
    {

        $data=$request->validated();

        $block->update($data);
        return redirect("program/show/{$block->program->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block)
    {
        $block->delete();
        return redirect()->back();
    }
}
