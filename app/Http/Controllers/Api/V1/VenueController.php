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
        $venue = $this->updateOrCreateVenueWithOpeningHours($request->validated(), $venue);
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

    public function updateOrCreateVenueWithOpeningHours(array $request_data, $existingVenue=null)
    {
        try {
            return DB::transaction(function () use ($request_data, $existingVenue) {
                if(!empty($data['venue_opening_hours'])) {
                    $venueOpeningHoursData = $request_data['venue_opening_hours'];
                }
                $data = Arr::except($request_data, ['venue_opening_hours']);
                $data['user_id'] = $venue->user_id ?? Auth::id();

                !empty($existingVenue) ?? $existing_venue_id['id'] = $existingVenue->id;
                
                $venue = Venue::updateOrCreate($existing_venue_id, $data);

                if(isset($venueOpeningHoursData) && is_array($venueOpeningHoursData)){
                    $venue->venueOpeningHours()->updateOrCreate($venueOpeningHoursData);
                }

                return $venue->fresh()->load('venueOpeningHours');
            });

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
