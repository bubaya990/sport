@extends('layouts.app')

@section('title', 'Liste des Participants')

@section('content')
    <h2>Participants inscrits</h2>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Ville</th>
                <th>Date Naissance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participants as $participant)
                <tr>
                    <td>{{ $participant->id }}</td>
                    <td>{{ $participant->nom }}</td>
                    <td>{{ $participant->prenom }}</td>
                    <td>{{ $participant->telephone }}</td>
                    <td>{{ $participant->ville }}</td>
                    <td>{{ $participant->date_naissance }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $participants->links() }}
@endsection
