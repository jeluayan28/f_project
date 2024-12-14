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
    public function index(Request $request)
    {
        $query = TouristSpot::with(['user', 'category']);

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'ILIKE', "%{$searchTerm}%");
        }
    
        $touristSpots = $query->get();
    
        return Inertia::render('TouristSpots/Index', [
            'touristSpots' => $touristSpots,
            'filters' => $request->only(['search']),
            'user' => Auth::user(),
        ]);
    }

    public function sort_rating()
    {
        $touristSpots = DB::select('SELECT * FROM view_spots_by_rating');

        $touristSpots = array_map(function ($spot) {
            $spot->category = (object) [
                'name' => DB::table('categories')->where('category_id', $spot->category_id)->value('name'),
            ];
            return $spot;
        }, $touristSpots);
  
        return Inertia::render('TouristSpots/Index', ['touristSpots' => $touristSpots,  'user' => Auth::user(),]);
    }

    public function beach_category()
    {
        $touristSpots = DB::select('SELECT * FROM view_beach_spots');

        $touristSpots = array_map(function ($spot) {
            $spot->category = (object) [
                'name' => DB::table('categories')->where('category_id', $spot->category_id)->value('name'),
            ];
            return $spot;
        }, $touristSpots);
  
        return Inertia::render('TouristSpots/Index', ['touristSpots' => $touristSpots,  'user' => Auth::user(),]);
    }

    public function heritage_category()
    {
        $touristSpots = DB::select('SELECT * FROM view_heritage_spots');

        $touristSpots = array_map(function ($spot) {
            $spot->category = (object) [
                'name' => DB::table('categories')->where('category_id', $spot->category_id)->value('name'),
            ];
            return $spot;
        }, $touristSpots);
  
        return Inertia::render('TouristSpots/Index', ['touristSpots' => $touristSpots,  'user' => Auth::user(),]);
    }
   

    public function mountain_category()
    {
        $touristSpots = DB::select('SELECT * FROM view_mountain_spots');

        $touristSpots = array_map(function ($spot) {
            $spot->category = (object) [
                'name' => DB::table('categories')->where('category_id', $spot->category_id)->value('name'),
            ];
            return $spot;
        }, $touristSpots);
  
        return Inertia::render('TouristSpots/Index', ['touristSpots' => $touristSpots,  'user' => Auth::user(),]);
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
    
        // Add the created_by field
        $validated['created_by'] = auth()->id();
        $validated['created_at'] = now();
        $validated['updated_at'] = now();
    
        // Use DB Facade to insert data
        DB::table('tourist_spots')->insert($validated);
    
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

    // Update the spot using the DB facade
    DB::table('tourist_spots')
        ->where('spot_id', $spot->spot_id)
        ->update([
            'name' => strip_tags($validated['name']),
            'location' => strip_tags($validated['location']),
            'description' => strip_tags($validated['description']),
            'rating' => $validated['rating'],
            'category_id' => $validated['category_id'],
            'updated_at' => now(), // Update timestamp
        ]);

    return redirect()->route('spot.show', $spot)->with('success', 'Tourist spot updated successfully.');
}


public function show($id)
{   
    $touristSpot = TouristSpot::with(['user', 'category'])->findOrFail($id);
    return Inertia::render('TouristSpots/Show', ['touristSpot' => $touristSpot, 'user' => Auth::user(),]);
}

public function destroy($id)
{
    $touristSpot = DB::table('tourist_spots')->where('spot_id', $id)->first();
    
    if (!$touristSpot) {
        return redirect()->route('spot.index')->with('error', 'Tourist spot not found.');
    }

    DB::table('tourist_spots')->where('spot_id', $id)->delete();
    return redirect()->route('spot.index')->with('success', 'Tourist spot deleted successfully.');
}
}