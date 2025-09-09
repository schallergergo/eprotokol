<?php

namespace App\Http\Controllers;

use App\Models\UsageLog;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsageLogRequest;
use App\Http\Requests\UpdateUsageLogRequest;

class UsageLogController extends Controller
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
     * @param  \App\Http\Requests\StoreUsageLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsageLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsageLog  $usageLog
     * @return \Illuminate\Http\Response
     */
    public function show(UsageLog $usageLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsageLog  $usageLog
     * @return \Illuminate\Http\Response
     */
    public function edit(UsageLog $usageLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsageLogRequest  $request
     * @param  \App\Models\UsageLog  $usageLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsageLogRequest $request, UsageLog $usageLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsageLog  $usageLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsageLog $usageLog)
    {
        //
    }
}
