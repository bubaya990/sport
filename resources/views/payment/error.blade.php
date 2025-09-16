@extends('layouts.app')

@section('title', 'Échec du Paiement')

@section('content')
<div class="max-w-2xl mx-auto my-10 p-8 bg-white rounded-xl shadow-md text-center">
    <h1 class="text-2xl font-bold text-red-600">❌ Paiement Échoué</h1>
    <p class="mt-4 text-gray-700">
        @if(session('error'))
            {{ session('error') }}
        @else
            Une erreur est survenue lors du paiement. Veuillez réessayer.
        @endif
    </p>
    <a href="{{ route('payment.index') }}" class="mt-6 inline-block px-6 py-3 bg-gray-600 text-white rounded-lg">Retour</a>
</div>
@endsection
