<?php

namespace App\Http\Controllers;

use App\Models\Evenement; 

class AdminController extends Controller
{
    
    public function dashboard() {
         $upcomingEvents = Evenement::where('status', '!=', 'completed')
            ->orderBy('date', 'asc')
            ->get();

        $completedEvents = Evenement::where('status', 'completed')
            ->orderBy('date', 'desc')
            ->get();

        return view('dashboard', compact('upcomingEvents', 'completedEvents'));
        return view('admin.dashboard');
    }

    public function events() {
        return view('admin.events');
    }
}
