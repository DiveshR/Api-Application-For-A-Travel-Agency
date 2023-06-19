<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travel;
use App\Http\Requests\Api\v1\TourRequest;
use App\Http\Resources\Api\v1\TourResource;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Travel $travel, TourRequest $request)
    {
       $tour =  $travel->tours()->create($request->validated());
        
        return new TourResource($tour);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
