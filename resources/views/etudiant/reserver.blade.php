@extends('layouts.etudiant')

@section('title', 'Réserver un local')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4 mx-auto" style="max-width: 500px;">

        <form method="GET" action="{{ route('locaux.disponibles') }}">
            @csrf

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" name="date" id="date" required>
            </div>
            <div class="mb-3">
                <label for="heure_debut" class="form-label">Heure de début</label>
                <input type="time" class="form-control" name="heure_debut" id="heure_debut" required>
            </div>
            <div class="mb-3">
                <label for="heure_fin" class="form-label">Heure de fin</label>
                <input type="time" class="form-control" name="heure_fin" id="heure_fin" required>
            </div>

            <button type="submit" class="btn btn-lg btn-primary px-5 py-3 shadow">
                Rechercher les locaux disponibles
            </button>
        </form>

    </div>
</div>
@endsection
