<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participant;
use Carbon\Carbon;

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
                'email' => 'karim.bennani@example.com',
                'sexe' => 'homme',
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
                'email' => 'nadia.zerrouki@example.com',
                'sexe' => 'femme',
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
                'email' => 'yacine.belaid@example.com',
                'sexe' => 'homme',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}