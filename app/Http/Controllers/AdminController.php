<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {   
        $statistics = DB::select('SELECT * from mv_category_summary');
        return Inertia::render('Admin/Index', ['statistics' => $statistics]);
    }

    public function refreshMaterializedView(){
        DB::statement('select refresh_mv_category_summary()');
        return redirect()->back()->with('message', 'Refresh successfully');
    }

    public function GetAvgRating(Request $request)
    {
        $avgrating = DB::selectOne('SELECT avg_rating_tourguide(?) as avg_rating', [$request->TourGuideName]);
        
        $statistics = DB::select('SELECT * from mv_category_summary');
        return Inertia::render('Admin/Index', [
            'statistics' => $statistics,
            'avgRatingResult' => $avgrating->avg_rating
        ]);
    }
    
    public function GetTourguideSpotlist(Request $request)
    {
        $tourspots = DB::select('SELECT * FROM tourguide_spot_list(?, ?)', [$request->TourGuideName, $request->Category]);
        $statistics = DB::select('SELECT * from mv_category_summary');
        return Inertia::render('Admin/Index', [
            'statistics' => $statistics,
            'spotList' => $tourspots,
            'spotListFetched' => true
        ]);
    }
}
