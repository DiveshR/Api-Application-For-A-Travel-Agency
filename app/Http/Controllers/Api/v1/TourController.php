<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travel;
use App\Http\Resources\api\v1\TourResource;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Travel $travel)
    {
        $tours = $travel->tours()
            ->orderBy('starting_date')
            ->paginate();

        return TourResource::collection($tours);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
