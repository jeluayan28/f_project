<?php

namespace App\Http\Controllers;

use App\Models\TouristSpot;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

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

    public function edit($spot)
{
    $touristSpot = DB::table('tourist_spots')->where('spot_id', $spot)->first();
    $categories = DB::table('categories')->get();

    return Inertia::render('TouristSpots/Edit', [
        'touristSpot' => $touristSpot,
        'categories' => $categories,
    ]);
}

public function update(Request $request, TouristSpot $spot)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'description' => 'required|string',
        'rating' => 'required|numeric|min:0|max:5',
        'category_id' => 'required|exists:categories,category_id',
    ]);

    $spot->update([
        'name' => strip_tags($validated['name']),
        'location' => strip_tags($validated['location']),
        'description' => strip_tags($validated['description']),
        'rating' => $validated['rating'],
        'category_id' => $validated['category_id'],
    ]);

    return redirect()->route('spot.show', $spot)->with('success', 'Tourist spot updated successfully.');
}

public function show($id)
{
    $touristSpot = TouristSpot::with(['user', 'category'])->findOrFail($id);
    return Inertia::render('TouristSpots/Show', ['touristSpot' => $touristSpot]);
}

public function destroy($id)
{
    $touristSpot = DB::table('tourist_spots')->where('spot_id', $id)->first();
    
    if (!$touristSpot) {
        return redirect()->route('spot.index')->with('error', 'Tourist spot not found.');
    }

    if (Auth::id() !== $touristSpot->created_by) {
        return redirect()->route('spot.index')->with('error', 'You are not authorized to delete this tourist spot.');
    }

    DB::table('tourist_spots')->where('spot_id', $id)->delete();
    return redirect()->route('spot.index')->with('success', 'Tourist spot deleted successfully.');
}
}