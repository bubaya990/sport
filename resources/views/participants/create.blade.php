@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
    <h2>Formulaire d’inscription</h2>

    <form method="POST" action="{{ route('participants.store') }}">
        @csrf
        <label>Nom:</label>
        <input type="text" name="nom" required>
        <br>

        <label>Prénom:</label>
        <input type="text" name="prenom" required>
        <br>

        <label>Téléphone:</label>
        <input type="text" name="telephone">
        <br>

        <label>Adresse:</label>
        <input type="text" name="adresse">
        <br>

        <label>Date de naissance:</label>
        <input type="date" name="date_naissance">
        <br>

        <label>Ville:</label>
        <input type="text" name="ville">
        <br>

        <label>Profession:</label>
        <input type="text" name="profession">
        <br>

        <button type="submit">S'inscrire</button>
    </form>
@endsection
