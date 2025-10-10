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
    public function index($eventId = null)
    {
        $event = $eventId ? Evenement::findOrFail($eventId) : null;

        // Get all scheduled and ongoing events
        $activeEvents = Evenement::whereIn('status', ['scheduled', 'ongoing'])
            ->orderBy('date', 'asc')
            ->get();

        return view('payment.payment', compact('event', 'activeEvents'));
    }

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
            'nationalite' => 'required|string|max:255',
            'wilaya' => 'required_if:nationalite,Algérie|nullable|string|max:255',
            'sexe' => 'required|in:homme,femme',
            'taille_maillot' => 'required|in:S,M,L,XL,XXL',
            'club' => 'nullable|string|max:255',
            'affilie_federation' => 'required|in:oui,non',
            'numero_licence' => 'required_if:affilie_federation,oui|nullable|string|max:255',
            'type_paiement' => 'required|in:visa,poste,carte_dor',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Find or create participant
        $participant = Participant::firstOrCreate(
            [
                'telephone' => $request->telephone,
                'email' => $request->email,
            ],
            [
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'adresse' => $request->adresse,
                'date_naissance' => $request->date_naissance,
                'nationalite' => $request->nationalite,
                'wilaya' => $request->wilaya,
                'sexe' => $request->sexe,
                'taille_maillot' => $request->taille_maillot,
                'club' => $request->club,
                'affilie_federation' => $request->affilie_federation,
                'numero_licence' => $request->numero_licence,
            ]
        );

        // Update participant if they already exist but with different details
        if (!$participant->wasRecentlyCreated) {
            $participant->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'adresse' => $request->adresse,
                'date_naissance' => $request->date_naissance,
                'nationalite' => $request->nationalite,
                'wilaya' => $request->wilaya,
                'sexe' => $request->sexe,
                'taille_maillot' => $request->taille_maillot,
                'club' => $request->club,
                'affilie_federation' => $request->affilie_federation,
                'numero_licence' => $request->numero_licence,
            ]);
        }

        $event = Evenement::findOrFail($request->evenement_id);

        $paiement = Paiement::create([
            'participant_id' => $participant->id,
            'evenement_id' => $event->id,
            'type' => $request->type_paiement,
            'transaction_id' => 'TRX_' . Str::upper(Str::random(10)),
            'montant' => $event->prix,
            'statut' => false,
        ]);

        // Mock redirect (simulating SATIM success)
        return redirect()->route('payment.mock.success', ['id' => $paiement->id]);
    }

    public function success($id)
    {
        $paiement = Paiement::with(['participant', 'evenement'])->findOrFail($id);
        return view('payment.success', compact('paiement'));
    }

    public function error()
    {
        return view('payment.error');
    }

    // Mock simulation
    public function mockSatimSuccess($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->update([
            'statut' => true,
            'paid_at' => now(),
        ]);

        return redirect()->route('payment.success', ['id' => $paiement->id]);
    }

    public function mockSatimError($id)
    {
        return redirect()->route('payment.error')
            ->with('error', 'Le paiement a échoué, veuillez réessayer.');
    }
}