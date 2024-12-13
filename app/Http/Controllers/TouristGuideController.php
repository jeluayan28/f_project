<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TouristSpot;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class TouristGuideController extends Controller
{
    public function index()
    {
        $touristSpot = TouristSpot::with(['user', 'category'])->get();
        return Inertia::render('TouristSpots/Touristguide', ['touristSpots' => $touristSpot]);
    }

    public function edit($spot)
    {
        $touristSpot = TouristSpot::findOrFail($spot);
        return Inertia::render('TouristSpots/Edit', ['touristSpot' => $touristSpot]);
    }

    public function update(Request $request, $spot)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rating' => 'required|numeric|min:0|max:5',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $touristSpot = TouristSpot::findOrFail($spot);

        // Log the changes before updating
        $beforeData = $touristSpot->toArray();
        $afterData = array_merge($beforeData, $validated);

        Log::create([
            'user_id' => Auth::id(),
            'action_type' => 'edit',
            'table_name' => 'tourist_spots',
            'before_data' => json_encode($beforeData),
            'after_data' => json_encode($afterData),
        ]);

        // Update the tourist spot
        $touristSpot->update($validated);

        return redirect()->route('guide.index')->with('success', 'Tourist spot updated successfully and changes logged.');
    }
}
