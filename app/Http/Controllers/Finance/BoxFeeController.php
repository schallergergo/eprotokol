<?php

namespace App\Http\Controllers\Finance;

use App\Models\BoxFee;
use App\Models\Competition;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoxFeeRequest;
use App\Http\Requests\UpdateBoxFeeRequest;


use App\Imports\BoxFeeImport;

class BoxFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Competition $competition)
    {
        $box_fees = $competition->box_fee->sortBy("rider_name")->sortBy("paid");
        return view("boxfee.index",["competition"=>$competition,"box_fees"=>$box_fees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Competition $competition)
    {
        return view("boxfee.create",["competition"=>$competition,"fees"=>$competition->box_fee]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoxFeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoxFeeRequest $request,Competition $competition)
    {
        $data = $request->validated();
        $data = array_merge($data,["competition_id"=>$competition->id]);
        $boxfee = BoxFee::create($data);
        return redirect("finance/show/".$competition->id);
        
    }


    public function import(Competition $competition){
        //$this->authorize('create', [Start::class,$event]);
         $data = request();
        $data=$data->validate([
            'importFile' => ['required','file','mimes:xlsx' ],
            ]);

        $out=[];

        

          $import = new BoxFeeImport($competition);

        $import->import($data["importFile"]->path(), null, \Maatwebsite\Excel\Excel::XLSX);

        $error=$import->errors();

        if (count($error)==0) return redirect("boxfee/create/{$competition->id}")->with("status","Successfully imported! ");
        dd($import->errors());
        return redirect("boxfee/create/{$competition->id}")->with("status","One of more rows skipped!");

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoxFee  $boxFee
     * @return \Illuminate\Http\Response
     */
    public function show(BoxFee $boxFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoxFee  $boxFee
     * @return \Illuminate\Http\Response
     */
    public function edit(BoxFee $boxFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoxFeeRequest  $request
     * @param  \App\Models\BoxFee  $boxFee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoxFeeRequest $request, BoxFee $boxFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoxFee  $boxFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoxFee $boxFee)
    {
        //
    }
}
