<?php

namespace App\Http\Controllers;

use App\Models\NearPlace;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NearPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('NearPlaces/Index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NearPlace  $nearPlace
     * @return \Illuminate\Http\Response
     */
    public function show(NearPlace $nearPlace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NearPlace  $nearPlace
     * @return \Illuminate\Http\Response
     */
    public function edit(NearPlace $nearPlace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NearPlace  $nearPlace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NearPlace $nearPlace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NearPlace  $nearPlace
     * @return \Illuminate\Http\Response
     */
    public function destroy(NearPlace $nearPlace)
    {
        //
    }
}
