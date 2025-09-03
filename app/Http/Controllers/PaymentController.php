<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Participant;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display the payment form for a specific event
     */
    public function index($eventId = null)
    {
        // Get the event if provided
        $event = null;
        if ($eventId) {
            $event = Evenement::findOrFail($eventId);
        }
        
        // Get all active events for dropdown
        $activeEvents = Evenement::where('status', 'scheduled')
            ->where('end_date', '>=', now())
            ->get();
            
        return view('payment.payment', compact('event', 'activeEvents'));
    }

    /**
     * Process the payment form submission
     */
    public function processPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evenement_id' => 'required|exists:evenements,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:500',
            'date_naissance' => 'required|date',
            'ville' => 'required|string|max:255',
            'sexe' => 'required|in:homme,femme',
            'taille_maillot' => 'required|in:S,M,L,XL,XXL',
            'type_paiement' => 'required|in:visa,poste,carte_dor',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if participant already exists
        $participant = Participant::where('telephone', $request->telephone)
            ->where('nom', $request->nom)
            ->where('prenom', $request->prenom)
            ->first();

        // If participant doesn't exist, create one
        if (!$participant) {
            $participant = Participant::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'adresse' => $request->adresse,
                'date_naissance' => $request->date_naissance,
                'ville' => $request->ville,
                'sexe' => $request->sexe,
                'taille_maillot' => $request->taille_maillot,
            ]);
        }

        // Get the event
        $event = Evenement::findOrFail($request->evenement_id);

        // Create payment record
        $paiement = Paiement::create([
            'participant_id' => $participant->id,
            'evenement_id' => $event->id,
            'type' => $request->type_paiement,
            'transaction_id' => 'TRX_' . Str::random(10),
            'paid_at' => now(),
            'montant' => $event->prix,
            'statut' => true,
        ]);

        return redirect()->route('payment.success', ['id' => $paiement->id])
            ->with('success', 'Votre inscription a été enregistrée avec succès!');
    }

    /**
     * Display payment success page
     */
    public function success($id)
    {
        $paiement = Paiement::with(['participant', 'evenement'])->findOrFail($id);
        return view('payment.success', compact('paiement'));
    }
}