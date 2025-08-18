<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paiement;
use Carbon\Carbon;

class PaiementSeeder extends Seeder
{
    public function run(): void
    {
        Paiement::insert([
            [
                'participant_id' => 1, // Karim
                'evenement_id' => 1, // Football Été
                'type' => 'visa',
                'transaction_id' => 'TRX1001',
                'paid_at' => Carbon::parse('2025-05-25'),
                'montant' => 1500.00,
                'statut' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'participant_id' => 2, // Nadia
                'evenement_id' => 2, // Natation Printemps
                'type' => 'poste',
                'transaction_id' => 'TRX1002',
                'paid_at' => Carbon::parse('2025-03-10'),
                'montant' => 1200.00,
                'statut' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'participant_id' => 3, // Yacine
                'evenement_id' => 1, // Football Été
                'type' => 'carte_dor',
                'transaction_id' => 'TRX1003',
                'paid_at' => Carbon::parse('2025-06-02'),
                'montant' => 1500.00,
                'statut' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
