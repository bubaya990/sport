<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participant;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        Participant::insert([
            [
                'nom' => 'Bennani',
                'prenom' => 'Karim',
                'telephone' => '0551234567',
                'adresse' => 'Rue 12, Alger',
                'date_naissance' => '1995-06-12',
                'ville' => 'Alger',
                'profession' => 'Ingénieur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Zerrouki',
                'prenom' => 'Nadia',
                'telephone' => '0559876543',
                'adresse' => 'Rue 8, Oran',
                'date_naissance' => '1992-04-05',
                'ville' => 'Oran',
                'profession' => 'Professeur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Belaid',
                'prenom' => 'Yacine',
                'telephone' => '0561237890',
                'adresse' => 'Rue 3, Constantine',
                'date_naissance' => '2000-09-21',
                'ville' => 'Constantine',
                'profession' => 'Étudiant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
