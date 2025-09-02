<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Municipality;
use App\Http\Requests\MunicipalityRequest;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Municipality::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MunicipalityRequest $request)
    {
        $validated = $request->validated();
        Municipality::create($validated);

        return response()->json(['message' => 'Municipality created successfully.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Municipality $municipality)
    {
        if ($municipality) {
            return response()->json($municipality);
        }

        return response()->json(['message' => 'Municipality not found.'], 404);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(MunicipalityRequest $municipality_request, Municipality $municipality)
    {
        $municipality->update($municipality_request->validated());
        return response()->json($municipality);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Municipality $municipality)
    {
        $municipality->delete();
        return response()->json(null, 204);
    }
}
