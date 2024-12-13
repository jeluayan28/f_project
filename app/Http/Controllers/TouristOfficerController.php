<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TouristSpot;



class TouristOfficerController extends Controller
{
    public function index()
    {
        $touristSpot = TouristSpot::with(['user', 'category'])->get();
        return Inertia::render('TouristSpots/Touristofficer', ['touristSpots' => $touristSpot]);
    }
}
