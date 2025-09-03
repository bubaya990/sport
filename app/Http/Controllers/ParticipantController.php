<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = Participant::query();
        
        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('ville', 'like', "%{$search}%")
                  ->orWhere('telephone', 'like', "%{$search}%");
            });
        }
        
        // Sex filter
        if ($request->has('sexe') && !empty($request->sexe)) {
            $query->where('sexe', $request->sexe);
        }
        
        // Size filter
        if ($request->has('size') && !empty($request->size)) {
            $query->where('size', $request->size);
        }
        
        // Ville filter
        if ($request->has('ville') && !empty($request->ville)) {
            $query->where('ville', $request->ville);
        }
        
        // Age range filter
        if ($request->has('age_range') && !empty($request->age_range)) {
            $ageRange = $request->age_range;
            $now = now();
            
            if ($ageRange === '60+') {
                $query->where('date_naissance', '<=', $now->subYears(60)->format('Y-m-d'));
            } else {
                list($minAge, $maxAge) = explode('-', $ageRange);
                $minDate = $now->subYears($maxAge + 1)->addDay()->format('Y-m-d');
                $maxDate = $now->subYears($minAge)->format('Y-m-d');
                $query->whereBetween('date_naissance', [$minDate, $maxDate]);
            }
        }
        
        // Get unique villes for filter dropdown
        $villes = Participant::whereNotNull('ville')
                            ->where('ville', '!=', '')
                            ->distinct()
                            ->pluck('ville')
                            ->sort();
        
        // Paginate results
        $participants = $query->orderBy('nom')->orderBy('prenom')->paginate(15);
        
        return view('participants.index', compact('participants', 'villes'));
    }
    
    public function show(Participant $participant)
    {
        return view('participants.show', compact('participant'));
    }
    
    public function create()
    {
        return view('participants.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email|unique:participants,email',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'date_naissance' => 'nullable|date',
            'ville' => 'nullable|string|max:255',
            'sexe' => 'nullable|in:homme,femme',
            'size' => 'nullable|in:XS,S,M,L,XL,XXL'
        ]);
        
        Participant::create($validated);
        
        return redirect()->route('participants.index')
                         ->with('success', 'Participant créé avec succès.');
    }
    
    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
    }
    
    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email|unique:participants,email,' . $participant->id,
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'date_naissance' => 'nullable|date',
            'ville' => 'nullable|string|max:255',
            'sexe' => 'nullable|in:homme,femme',
            'size' => 'nullable|in:XS,S,M,L,XL,XXL'
        ]);
        
        $participant->update($validated);
        
        return redirect()->route('participants.index')
                         ->with('success', 'Participant mis à jour avec succès.');
    }
    
    public function destroy(Participant $participant)
    {
        $participant->delete();
        
        return redirect()->route('participants.index')
                         ->with('success', 'Participant supprimé avec succès.');
    }
}