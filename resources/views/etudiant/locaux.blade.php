@extends('layouts.etudiant')

@section('title', 'Liste des locaux')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">Liste des locaux disponibles</h2>

    <!-- Afficher les critères de recherche -->
    <div class="alert alert-info mb-4">
        <p>Créneau sélectionné :</p>
        <p>Date: {{ $date }}</p>
        <p>Heure de début: {{ $heure_debut }}</p>
        <p>Heure de fin: {{ $heure_fin }}</p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($locaux as $local)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $local->nom }}</h5>
                        <p class="card-text">Type : {{ $local->type }}</p>
                        <p class="card-text">Capacité : {{ $local->capacite }}</p>

                       <form method="POST" action="{{ route('reservation.create', $local->id) }}">
                            @method('POST')
                              @csrf
                            <input type="hidden" name="date" value="{{ $date }}">
                            <input type="hidden" name="heure_debut" value="{{ $heure_debut }}">
                            <input type="hidden" name="heure_fin" value="{{ $heure_fin }}">
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                Réserver
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
