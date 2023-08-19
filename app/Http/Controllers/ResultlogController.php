<?php

namespace App\Http\Controllers;

use App\Models\Resultlog;
use App\Models\Result;
use App\Http\Requests\StoreResultlogRequest;
use App\Http\Requests\UpdateResultlogRequest;

class ResultlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Result $result)
    {

        $resultlogs=$result->resultlog;
        return view("resultlog.index",["resultlogs"=>$resultlogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResultlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResultlogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resultlog  $resultlog
     * @return \Illuminate\Http\Response
     */
    public function show(Resultlog $resultlog)
    {
        $assessment=json_decode($resultlog["assessment"]);
        $start=$resultlog->result->start;
        $result=$resultlog->result;
        //first part of the program, with the moves to be executed
        $blocks=$result->start->event->program->block->where("programpart",1); 

        //second part, with the criteria for the collective marks
        $collectivemarks=$result->start->event->program->block->where("programpart",2); 

        //errors made by the rider, aka deductions

        // bool: is the rider eliminated?
        $eliminated=$result->eliminated; 



        return view("resultlog.show",[ "result"=>$result, 
                                    "resultlog"=>$resultlog, 
                                    "blocks"=>$blocks,
                                    "collectivemarks"=>$collectivemarks,
                                    "assessment"=>$assessment,
                                    "start"=>$start,
                                    "eliminated"=>$eliminated,
                                ]);
    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resultlog  $resultlog
     * @return \Illuminate\Http\Response
     */
    public function edit(Resultlog $resultlog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResultlogRequest  $request
     * @param  \App\Models\Resultlog  $resultlog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResultlogRequest $request, Resultlog $resultlog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resultlog  $resultlog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resultlog $resultlog)
    {
        //
    }

     public function replicateResultLog(Result $result){


         foreach($result->resultlog as $resultlog) {
            $newlog = $resultlog->replicate();
            $newlog->result_id = $result->id;
            $newlog->save();
        }
}
       

        
       

}
