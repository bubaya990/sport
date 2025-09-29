<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\AboutUs; // Add this import

class SiteController extends Controller
{
    public function dashboard()
    {
        $upcomingEvents = Evenement::where('status', '!=', 'completed')
            ->orderBy('date', 'asc')
            ->get();

        $completedEvents = Evenement::where('status', 'completed')
            ->orderBy('date', 'desc')
            ->get();

        // Get AboutUs data (assuming you have only one record)
        $aboutUs = AboutUs::first();

        return view('site.dashboard', compact('upcomingEvents', 'completedEvents', 'aboutUs'));
    }
}