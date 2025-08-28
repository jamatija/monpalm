<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVenueTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Store;

use App\Models\VenueType;

class VenueTypeController extends Controller
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
    public function store(StoreVenueTypeRequest $request)
    {
        $venueType = VenueType::create($request->validated());
        return response()->json($venueType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VenueType $venueType)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VenueType $venueType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VenueType $venueType)
    {
        //
    }
}
