<?php

namespace App\Http\Controllers;

use App\Models\TouristSpot;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TouristSpotController extends Controller
{
    public function index()
    {
        $touristSpots = TouristSpot::with(['user', 'category'])->get();
        return Inertia::render('TouristSpots/Index', ['touristSpots' => $touristSpots]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('TouristSpots/Create', ['categories' => $categories,]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rating' => 'required|numeric|min:0|max:5',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $validated['created_by'] = auth()->id();

        TouristSpot::create($validated);

        return redirect()->route('spot.index')->with('success', 'Tourist spot created successfully.');
    }

    public function edit(TouristSpot $touristSpot)
    {
        return Inertia::render('TouristSpots/Edit', ['touristSpot' => $touristSpot]);
    }

    public function update(Request $request, TouristSpot $touristSpot)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rating' => 'required|numeric|min:0|max:5',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $touristSpot->update($validated);

        return redirect()->route('spot.index')->with('success', 'Tourist spot updated successfully.');
    }

    public function destroy(TouristSpot $touristSpot)
    {
        $touristSpot->delete();
        return redirect()->route('spot.index')->with('success', 'Tourist spot deleted successfully.');
    }

    public function show($id)
    {   
        $touristSpot = TouristSpot::with(['user', 'category'])->findOrFail($id);
        
        return Inertia::render('TouristSpots/Show', ['touristSpot' => $touristSpot]);
    }
}