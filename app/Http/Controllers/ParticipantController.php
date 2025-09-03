<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the participants.
     */
    public function index()
    {
        // Paginate results (10 per page)
        $participants = Participant::paginate(10);

        return view('participants.index', compact('participants'));
    }

    /**
     * Show the form for creating a new participant.
     */
    public function create()
    {
        return view('participants.create');
    }

    /**
     * Store a newly created participant in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            'telephone'      => 'required|string|max:20',
            'ville'          => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
        ]);

        Participant::create($validated);

        return redirect()->route('participants.index')
                         ->with('success', 'Participant created successfully!');
    }

    /**
     * Show the form for editing the specified participant.
     */
    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
    }

    /**
     * Update the specified participant in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            'telephone'      => 'required|string|max:20',
            'ville'          => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
        ]);

        $participant->update($validated);

        return redirect()->route('participants.index')
                         ->with('success', 'Participant updated successfully!');
    }

    /**
     * Remove the specified participant from storage.
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();

        return redirect()->route('participants.index')
                         ->with('success', 'Participant deleted successfully!');
    }
}
