<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Support\Str;

class HighlightController extends Controller
{
    /**
     * Prikaži listu highlight-ova.
     */
    public function index()
    {
        return response()->json(Highlight::all());
    }

    /**
     * Sačuvaj novi highlight.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255|unique:highlights,name',
            'category' => 'required|string|max:255',
        ]);

        // generišemo slug automatski
        $validated['slug'] = Str::slug($validated['name']);

        $highlight = Highlight::create($validated);

        return response()->json($highlight, 201);
    }

    /**
     * Prikaži konkretan highlight.
     */
    public function show(Highlight $highlight)
    {
        return response()->json($highlight);
    }

    /**
     * Izmeni highlight.
     */
    public function update(Request $request, Highlight $highlight)
    {
        $validated = $request->validate([
            'name'     => 'sometimes|required|string|max:255|unique:highlights,name,' . $highlight->id,
            'category' => 'sometimes|required|string|max:255',
        ]);

        if (isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $highlight->update($validated);

        return response()->json($highlight);
    }

    /**
     * Obriši highlight.
     */
    public function destroy(Highlight $highlight)
    {
        $highlight->delete();
        return response()->json(null, 204);
    }
}