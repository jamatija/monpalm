<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVenueRequest;
use App\Models\Venue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Venue::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVenueRequest $request)
    {
        $venue = $this->createVenueWithOpeningHours($request->validated());
        return response()->json($venue->load('venueOpeningHours'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        return response()->json($venue->load('venueOpeningHours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        $venue->update($request->all());
        return response()->json($venue->load('venueOpeningHours'));  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return response()->json(null, 204);
    }

    public function createVenueWithOpeningHours(array $data)
    {

        try {
            return DB::transaction(function () use ($data) {
                $openingHoursData = $data['venue_opening_hours'];
                unset($data['venue_opening_hours']);
                
                $venue = Venue::create($data);
                
                Log::info('Creating venue with data:', $data);

                foreach ($openingHoursData as $openingHour) {
                    $venue->venueOpeningHours()->create($openingHour);
                }

                return $venue->fresh()->load('venueOpeningHours');
            });

        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Database error occurred while creating venue: ' . $e->getMessage());
            
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
