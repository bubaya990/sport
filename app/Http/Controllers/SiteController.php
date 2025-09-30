<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\AboutUs;

class SiteController extends Controller
{
    public function dashboard()
    {
        $upcomingEvents = Evenement::where('status', '!=', 'completed')
            ->orderBy('date', 'asc')
            ->get();

        // Get ONLY the last 4 completed events
        $completedEvents = Evenement::where('status', 'completed')
            ->orderBy('date', 'desc')
            ->limit(4) // Limit to 4 events only
            ->get();

        // Get AboutUs data
        $aboutUs = AboutUs::first();

        return view('site.dashboard', compact('upcomingEvents', 'completedEvents', 'aboutUs'));
    }
}