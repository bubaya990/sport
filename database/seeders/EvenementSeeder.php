<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evenement;

class EvenementSeeder extends Seeder
{
    public function run(): void
    {
        Evenement::insert([
            [
                'titre' => 'Plan Football Été',
                'description' => 'Programme d’entraînement intensif de football pour l’été.',
                'date' => '2025-06-01',
                'end_date' => '2025-08-31',
                'prix' => 1500.00,
                'status' => 'scheduled',
                'images' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Stage Natation Printemps',
                'description' => 'Cours et entraînement de natation pour tous niveaux.',
                'date' => '2025-03-15',
                'end_date' => '2025-04-15',
                'prix' => 1200.00,
                'status' => 'completed',
                'images' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Plan Fitness Automne',
                'description' => 'Programme fitness pour perte de poids et renforcement.',
                'date' => '2025-09-10',
                'end_date' => '2025-11-30',
                'prix' => 1000.00,
                'status' => 'scheduled',
                'images' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
