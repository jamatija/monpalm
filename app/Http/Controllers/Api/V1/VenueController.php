<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Models\Venue;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json(Venue::with('venueOpeningHours')->paginate($this->resolvePerPage($request)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVenueRequest $request)
    {
        $venue = $this->updateOrCreateVenueWithOpeningHours($request->validated());
        return response()->json($venue->load('venueOpeningHours'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        return $venue->load('venueOpeningHours');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVenueRequest $request, Venue $venue)   
    {
        $venue->update($request->validated());
        return $venue->load('venueOpeningHours');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return response()->noContent();
    }

    public function updateOrCreateVenueWithOpeningHours(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                if($data['venue_opening_hours']) {
                    $venueOpeningHoursData = $data['venue_opening_hours'];
                }
                $data = Arr::except($data, ['venue_opening_hours']);
                $data['user_id'] = Auth::id();

                $venue = Venue::updateOrCreate($data);

                if(isset($venueOpeningHoursData) && is_array($venueOpeningHoursData)){
                    $venue->venueOpeningHours()->createMany($venueOpeningHoursData);
                }

                return $venue->fresh()->load('venueOpeningHours');
            });

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
