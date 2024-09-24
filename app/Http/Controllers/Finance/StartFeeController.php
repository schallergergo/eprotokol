<?php

namespace App\Http\Controllers\Finance;

use App\Models\StartFee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStartFeeRequest;
use App\Http\Requests\UpdateStartFeeRequest;

class StartFeeController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStartFeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStartFeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StartFee  $startFee
     * @return \Illuminate\Http\Response
     */
    public function show(StartFee $startFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StartFee  $startFee
     * @return \Illuminate\Http\Response
     */
    public function edit(StartFee $startFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStartFeeRequest  $request
     * @param  \App\Models\StartFee  $startFee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStartFeeRequest $request, StartFee $startFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StartFee  $startFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(StartFee $startFee)
    {
        //
    }
}
