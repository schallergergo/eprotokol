<?php

namespace App\Http\Controllers;

use App\Models\Furioso;
use App\Http\Requests\StoreFuriosoRequest;
use App\Http\Requests\UpdateFuriosoRequest;

class FuriosoController extends Controller
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
     * @param  \App\Http\Requests\StoreFuriosoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFuriosoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Furioso  $furioso
     * @return \Illuminate\Http\Response
     */
    public function show(Furioso $furioso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Furioso  $furioso
     * @return \Illuminate\Http\Response
     */
    public function edit(Furioso $furioso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFuriosoRequest  $request
     * @param  \App\Models\Furioso  $furioso
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFuriosoRequest $request, Furioso $furioso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Furioso  $furioso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Furioso $furioso)
    {
        //
    }
}
