<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Evenement; 

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

    return view('site.dashboard', compact('upcomingEvents', 'completedEvents'));
}

}
