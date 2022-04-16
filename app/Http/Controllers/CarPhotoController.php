<?php

namespace App\Http\Controllers;

use App\Models\CarPhoto;
use App\Http\Requests\StoreCarPhotoRequest;
use App\Http\Requests\UpdateCarPhotoRequest;

class CarPhotoController extends Controller
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
     * @param  \App\Http\Requests\StoreCarPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarPhotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarPhoto  $carPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(CarPhoto $carPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarPhoto  $carPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(CarPhoto $carPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarPhotoRequest  $request
     * @param  \App\Models\CarPhoto  $carPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarPhotoRequest $request, CarPhoto $carPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarPhoto  $carPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarPhoto $carPhoto)
    {
        //
    }
}
