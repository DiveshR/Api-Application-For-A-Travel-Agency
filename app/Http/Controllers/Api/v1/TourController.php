<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travel;
use App\Http\Requests\Api\v1\TourListRequest;
use App\Http\Resources\api\v1\TourResource;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Travel $travel, TourListRequest $request)
    {
        $tours = $travel->tours()
            ->when($request->priceFrom, function ($query) use ($request){
                $query->where('price','>=',$request->priceFrom * 100);
            })
            ->when($request->priceTo, function ($query) use ($request){
                $query->where('price','<=',$request->priceTo * 100);
            })
            ->when($request->dateFrom, function ($query) use ($request){
                $query->where('starting_date','>=',$request->dateFrom);
            })
            ->when($request->dateTo, function ($query) use ($request){
                $query->where('ending_date', '<=', $request->dateTo);
            })
            ->when($request->sortBy && $request->sortOrder, function ($query) use ($request){
                $query->orderBy($request->sortBy , $request->sortOrder);
            })
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
