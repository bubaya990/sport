@extends('layouts.app')

@section('title', 'Paiement Réussi')

@section('content')
<div class="max-w-2xl mx-auto my-10 p-8 bg-white rounded-xl shadow-md text-center">
    <h1 class="text-2xl font-bold text-green-600">✅ Paiement Réussi</h1>
    <p class="mt-4">Merci {{ $paiement->participant->prenom }} {{ $paiement->participant->nom }} !</p>

    <div class="mt-6 text-left">
        <h2 class="font-semibold">Détails de l’inscription :</h2>
        <ul class="mt-2 list-disc pl-5">
            <li>Événement : {{ $paiement->evenement->titre }}</li>
            <li>Date : {{ $paiement->evenement->date->format('d/m/Y') }}</li>
            <li>Montant : {{ $paiement->montant }} DA</li>
            <li>Méthode : {{ ucfirst($paiement->type) }}</li>
            <li>Transaction ID : {{ $paiement->transaction_id }}</li>
        </ul>
    </div>

    <a href="{{ route('payment.index') }}" class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg">Retour</a>
</div>
@endsection
